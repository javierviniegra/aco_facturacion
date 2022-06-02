<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;

final class CompraProductosAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('litros')
            ->add('precioLitro')
            ->add('requiereIeps')
            ->add('factorIeps')
            ->add('totalIeps')
            ->add('iva')
            ->add('subtotal')
            ->add('total')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('litros')
            ->add('precioLitro')
            ->add('requiereIeps')
            ->add('factorIeps')
            ->add('totalIeps')
            ->add('iva')
            ->add('subtotal')
            ->add('total')
            ->add('created_at')
            ->add('updated_at')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('producto', ModelType::class, [
                    'required' => true,
                    'expanded' => false,
                    'multiple' => false,
            ])
            ->add('litros', NumberType::class, ['label' => 'Cantidad','required' => false,'grouping' => true])
            ->add('precioLitro', MoneyType::class, [
                'currency' => 'MXN',
                'label' => 'Precio',
                'required' => false,
                'grouping' => true,
                'scale' => 6
            ])
            ->add('producto', ModelType::class, [
                'required' => false,
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('requiereIeps',null,['label' => 'Requiere IEPS','required' => false])
            ->add('factorIeps', NumberType::class, [
                'label' => 'Factor IEPS',
                'required' => false,
                'grouping' => true,
                'scale' => 6
            ])
            ->add('totalIeps', MoneyType::class, [
                'currency' => 'MXN',
                'label' => 'IEPS Total',
                'grouping' => true,
                'scale' => 6
            ])
            ->add('iva', MoneyType::class, [
                'currency' => 'MXN',
                'label' => 'IVA',
                'grouping' => true,
                'scale' => 6
            ])
            ->add('subtotal', MoneyType::class, [
                'currency' => 'MXN',
                'label' => 'Subtotal',
                'grouping' => true,
                'scale' => 6
            ])
            ->add('total', MoneyType::class, [
                'currency' => 'MXN',
                'label' => 'Total',
                'grouping' => true,
                'scale' => 6
            ])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('producto')
            ->add('litros')
            ->add('precioLitro')
            ->add('requiereIeps')
            ->add('factorIeps')
            ->add('totalIeps')
            ->add('iva')
            ->add('subtotal')
            ->add('total')
            ->add('created_at')
            ->add('updated_at')
            ;
    }
}