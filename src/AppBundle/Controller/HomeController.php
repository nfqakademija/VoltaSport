<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{

    /**
     * @Route("/", name="app.homepage")
     */
    public function indexAction()
    {
//       $foo = $this->get("d");
        return $this->render('AppBundle:Home:index.html.twig', []);
    }
}
