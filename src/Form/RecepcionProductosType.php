<?php

namespace App\Form;

use App\Entity\CompraProductos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RecepcionProductosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('almacenaje',null,[
                'label' => 'Almacenaje'
            ])
            ->add('quienRecibe',null,[
                'label' => 'Persona Recibio'
            ])
            ->add('fechaRecepcion',DateTimeType::class,[
                'label' => 'Fecha y Hora de Recepción'
            ])
            ->add('observaciones', TextareaType::class)
           ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'save, button primary'],
            ]); 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompraProductos::class,
        ]);
    }
}
