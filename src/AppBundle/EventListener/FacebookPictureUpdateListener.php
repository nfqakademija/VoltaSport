<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class FacebookPictureUpdateListener
{
    private $clientRegistry;
    private $em;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
    }

    public function onLoginSuccess(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $client = $this->clientRegistry->getClient('facebook_main');
        $provider = $client->getOAuth2Provider();
        if ($user->getFacebookToken()) {
            $longLivedToken = $provider->getLongLivedAccessToken($user->getFacebookToken());
            $facebookUser = $client->fetchUserFromToken($longLivedToken);
            $user->setFacebookPhoto($facebookUser->getPictureUrl());
            $this->em->flush();
        }
    }
}
