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
        $token = $event->getAuthenticationToken()->getUser()->getFacebookToken();
        $client = $this->clientRegistry->getClient('facebook_main');
        $provider = $client->getOAuth2Provider();
        $longLivedToken = $provider->getLongLivedAccessToken($token);
        $facebookUser = $client->fetchUserFromToken($longLivedToken);

        $user = $event->getAuthenticationToken()->getUser();
        $user->setFacebookPhoto($facebookUser->getPictureUrl());
        $this->em->flush();
    }
}