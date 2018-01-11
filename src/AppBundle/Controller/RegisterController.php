<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        $registerDatas = array();

        // Récupère dans un tableau les erreurs de validation
        $errors = array();
        foreach ($form as $fieldName => $formField)
        {
            foreach ($formField->getErrors(true) as $error)
            {
                $errors[$fieldName] = $error->getMessage();
            }
        }

        if ($form->isSubmitted() && $form->isValid() && empty($errors))
        {
            try {
                // On sauvegarde le user
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $registerDatas = array('state' => true, 'message' => $this->get('translator')->trans('Registration succed'));
            }
            catch (\Doctrine\DBAL\DBALException $e)
            {
                $registerDatas = array('state' => false, 'message' => $this->get('translator')->trans('Registration failed'));
            }
        }

        return $this->render('@App/Register/register.html.twig', array(
            'form'          => $form->createView(),
            'registerDatas' => $registerDatas,
            'errors'        => $errors,
            'loginLibelle'  => $this->get('translator')->trans('Login'),
        ));
    }
}
