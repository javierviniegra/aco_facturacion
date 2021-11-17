<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder
             ->add('firstname',null, [
                'required'   => true,
                'label' => 'Nombre',
            ])
             ->add('phone',null, [
                'required'   => true,
                'label' => 'Whatsapp (10 dígitos)',
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'save, button primary'],
            ]); 


        $builder->remove('username');
    }

    public function getParent() 
    {
        return BaseRegistrationFormType::class;
    }
    
    public function getBlockPrefix()
    { 
        return 'app_user_registration';
    }
}