<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller {

    /**
     * @Route("/login")
     */
    public function loginAction(Request $request) {
        $user = new User();
        $loginForm = $this->createForm(UserType::class, $user)->add('login', SubmitType::class, array(
            'label' => 'Login',
            'attr' => array('class' => 'btn btn-primary btn-lg btn-block login-button'),
        ));
        $actionForm = $this->generateUrl('login_route');
        $loginErrors = array();

        $loginForm->handleRequest($request);
        // Si on clique sur le bounton "S'identifier"
        if ($loginForm->isSubmitted()) {
            try {
                $usernamePosted = $loginForm->getData()->getUsername();
                $passwordPosted = $loginForm->getData()->getPassword();
                // On checke si le user existe
                $user = $this->getDoctrine()
                        ->getRepository(User::class)
                        ->findOneBy(array('username' => $usernamePosted, 'password' => $passwordPosted));

                // Si il n'existe pas
                if ($user) {
                    // On se ridirige vers la page d'accueil
                    return $this->redirectToRoute('home_page');
                } else {
                    $loginErrors = array('message' => $this->get('translator')->trans("This user doesn't exists"));
                }
            } catch (\Doctrine\DBAL\DBALException $e) {
                
            }
        }

        return $this->render('@App/Security/login.html.twig', array(
                    'form' => $loginForm->createView(),
                    'action' => $actionForm,
                    'loginErrors' => $loginErrors,
                    'registerLibelle' => $this->get('translator')->trans('Register'),
        ));
    }

}
