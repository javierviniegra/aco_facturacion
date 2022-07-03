<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemperatureType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'scale' => 0,
            'symbol' => '°C',
            'type' => 'integer',
            'compound' => false,
        ]);

        $resolver->setAllowedValues('type', [
            'fractional',
            'integer',
        ]);

        $resolver->setAllowedTypes('scale', 'int');
        $resolver->setAllowedTypes('symbol', ['string']);
    }

    protected static function getPattern($temperature)
    {
        if (!$temperature) {
            return '{{ widget }}';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'temperature';
    }
}