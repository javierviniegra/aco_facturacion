<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ElegirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('nombre', TextType::class)
           ->add('email', TextType::class)
           ->add('fecha', TextType::class)
           ->add('hora', ChoiceType::class, [
                'choices'  => [
                 '08:00 am' =>  '8am',
                 '09:00 am' =>  '9am',
                 '10:00 am' => '10am',
                 '11:00 am' => '11am',
                 '12:00 am' => '12am',
                 '01:00 pm' =>  '1pm',
                 '02:00 pm' =>  '2pm',
                 '03:00 pm' =>  '3pm',
                 '04:00 pm' =>  '4pm',
                 '05:00 pm' =>  '5pm',
                 '06:00 pm' =>  '6pm',
                 '07:00 pm' =>  '7pm',
                 '08:00 pm' =>  '8pm'
                ],
            ])
           ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'save, button primary'],
            ]); 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
