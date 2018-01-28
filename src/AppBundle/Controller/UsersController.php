<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UsersController extends Controller {

    /**
     * @Route("/users")
     */
    public function usersAction() {
        return $this->render('AppBundle:Users:users.html.twig', array('username' => 'Florian'
                        )
                        // ...
        );
    }

}
