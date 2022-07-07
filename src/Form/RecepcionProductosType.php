<?php

namespace App\Form;

use App\Entity\CompraProductos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\Type\TemperatureType;

class RecepcionProductosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('almacenaje',null,[
                'label' => 'Almacenaje',
                'required' => true
            ])
            ->add('quienRecibe',null,[
                'label' => 'Persona que Recibio'
            ])
            ->add('temperatura',TemperatureType::class,[
                'label' => 'Temperatura °C',
                'required' => false
            ])
            ->add('presion_absoluta',null,[
                'label' => 'Presión Absoluta',
                'required' => false
            ])
            ->add('fechaRecepcion',DateType::class,[
                'label' => 'Fecha de Recepción',
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datetimepicker'],
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
