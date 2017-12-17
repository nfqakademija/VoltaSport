<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class HomeController.
 *
 * @Route("/")
 */
class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Supplement');
        $supplements    = $repository->findAll();

        return $this->render('AppBundle:Home:index.html.twig', [
            'supplements' => $supplements
        ]);
    }

    /**
     * @Route("/login", name="user_login")
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('AppBundle:User:login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}
