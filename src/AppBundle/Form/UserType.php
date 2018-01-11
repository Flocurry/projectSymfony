<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('firstname', null, array('label' => 'Firstname',
                    'attr' => array('placeholder' => 'Enter your Firstname', 'class' => 'form-control'),
                    'label_attr' => array('class' => 'cols-sm-2 control-label')))
                ->add('lastname', null, array('label' => 'Lastname',
                    'attr' => array('placeholder' => 'Enter your Lastname', 'class' => 'form-control'),
                    'label_attr' => array('class' => 'cols-sm-2 control-label')))
                ->add('username', null, array('label' => 'Username',
                    'attr' => array('placeholder' => 'Enter your Username', 'class' => 'form-control'),
                    'label_attr' => array('class' => 'cols-sm-2 control-label')))
                ->add('email', EmailType::class, array('label' => 'Email',
                    'attr' => array('placeholder' => 'Enter your Email', 'class' => 'form-control'),
                    'label_attr' => array('class' => 'cols-sm-2 control-label')))
                ->add('password', null, array('label' => 'Password',
                    'attr' => array('placeholder' => 'Enter your Password', 'class' => 'form-control'),
                    'label_attr' => array('class' => 'cols-sm-2 control-label')))
                ->add('save', SubmitType::class, array(
                    'label' => 'Register',
                    'attr' => array('class' => 'btn btn-primary btn-lg btn-block login-button'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'translation_domain' => 'messages',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_user';
    }

}
