<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class HomeController.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * @Route("/orders", name="user_orders")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:User:index.html.twig', []);
    }
}
