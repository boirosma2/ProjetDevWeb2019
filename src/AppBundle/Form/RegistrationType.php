<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom');
        $builder->add('prenom');

        //decommenter la partie suivante pour directement remplir la case $roles
        //puis commenter la partie suivante
        $builder->add('roles', ChoiceType::class, array(
            'choices' => array(
                'CHEF' => 'ROLE_CHEF',
                'DEVELOPPEUR' => 'ROLE_DEV'
            ),
            'expanded'=> true,
            'multiple' => true,
            'required' => true
        ));
        /*$builder
            ->add('fonction', ChoiceType::class, array(
                'choices' => array(
                    'Chef de projet' => 'CHEF_PROJET',
                    'Developpeur' => 'DEVELOPPEUR'
                ),
                'expanded'=> true,
                'multiple' => false,
                'required' => true
            ));*/
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getNom()
    {
        return $this->getBlockPrefix();
    }
    public function getPrenom()
    {
        return $this->getBlockPrefix();
    }
    public function getFonction()
    {
        return $this->getBlockPrefix();
    }
}
