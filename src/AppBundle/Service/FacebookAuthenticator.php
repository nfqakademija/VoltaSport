<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookAuthenticator extends SocialAuthenticator
{
    private $clientRegistry;
    private $em;
    private $router;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/connect/facebook/check') {
            return;
        }

        return $this->fetchAccessToken($this->getFacebookClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $client = $this->getFacebookClient();

        $facebookUser = $client->fetchUserFromToken($credentials);

        $provider = $client->getOAuth2Provider();
        $token = $provider->getLongLivedAccessToken($credentials);

        $existingUser = $this->em->getRepository(User::class)
            ->findOneBy(['facebookId' => $facebookUser->getId()]);

        if ($existingUser) {
            return $existingUser;
        }

        $user = new User();

        $user->setEmail($facebookUser->getEmail());
        $user->setName($facebookUser->getName());
        $user->setUsername($facebookUser->getName());
        $user->setFacebookId($facebookUser->getId());
        $user->setRoles(['ROLE_USER']);
        $user->setFacebookToken($token);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @return FacebookClient
     */
    private function getFacebookClient()
    {
        return $this->clientRegistry
            ->getClient('facebook_main');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // TODO: Implement onAuthenticationFailure() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('/');
    }
}
