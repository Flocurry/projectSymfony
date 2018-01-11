<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/home")
     */
    public function homeAction(Request $request)
    {
        return $this->render('AppBundle:Home:home.html.twig', array(
        ));

    }
}
