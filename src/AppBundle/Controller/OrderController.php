<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class OrderController.
 */
class OrderController extends Controller
{

    /**
     * @Route("/order", name="order")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:About:index.html.twig', []);
    }
}
