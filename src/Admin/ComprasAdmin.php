<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

final class ComprasAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('fechaCompra')
            ->add('id_compra')
            ->add('litros')
            ->add('precioLitro')
            ->add('iepsFactor')
            ->add('iepsTotal')
            ->add('iva')
            ->add('subtotal')
            ->add('total')
            ->add('fechaPago')
            ->add('numFactura')
            ->add('idTransaccion')
            ->add('fechaRecepcion')
            ->add('observaciones')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('fechaCompra','date')
            ->add('id_compra')
            ->add('litros')
            ->add('precioLitro', 'currency', ['currency' => 'MXN'])
            ->add('iepsFactor','percentage')
            ->add('iepsTotal', 'currency', ['currency' => 'MXN'])
            ->add('iva', 'currency', ['currency' => 'MXN'])
            ->add('subtotal', 'currency', ['currency' => 'MXN'])
            ->add('total', 'currency', ['currency' => 'MXN'])
            ->add('fechaPago','date')
            ->add('numFactura')
            ->add('idTransaccion')
            ->add('fechaRecepcion','date')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        // define group zoning
        $form
            ->tab('Compras')
                ->with('Compras', ['class' => 'col-md-6'])->end()
                ->with('Cálculos', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Recepción')
                ->with('General', ['class' => 'col-md-6'])->end()
            ->end();

        $now = new \DateTime();

        $form
            ->tab('Compras')
                ->with('Compras')
                    ->add('id_compra',null,['label' => 'ID de Compra','required' => true])
                    ->add('fechaCompra', DateType::class, ['label' => 'Fecha de Compra', 'widget' => 'single_text','required' => false])
                    ->add('proveedor', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('litros', NumberType::class, ['label' => 'Litros','required' => false])
                    ->add('precioLitro', MoneyType::class, [
                        'currency' => 'MXP',
                        'divisor' => 100,
                        'label' => 'Precio por litro',
                        'required' => false
                    ])
                    ->add('producto', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('requiereIeps',null,['label' => 'Requiere IEPS','required' => false])
                    ->add('iepsFactor', NumberType::class, ['label' => 'Factor IEPS','required' => false])
                ->end()
                ->with('Cálculos')
                    ->add('iepsTotal', MoneyType::class, [
                        'currency' => 'MXP',
                        'divisor' => 100,
                        'label' => 'IEPS Total',
                    ])
                    ->add('iva', MoneyType::class, [
                        'currency' => 'MXP',
                        'divisor' => 100,
                        'label' => 'IVA',
                    ])
                    ->add('subtotal', MoneyType::class, [
                        'currency' => 'MXP',
                        'divisor' => 100,
                        'label' => 'Subtotal',
                    ])
                    ->add('total', MoneyType::class, [
                        'currency' => 'MXP',
                        'divisor' => 100,
                        'label' => 'Total',
                    ])
                ->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación')
                    ->add('fechaPago', DateType::class, ['label' => 'Fecha de Pago', 'widget' => 'single_text','required' => false])
                    ->add('numFactura',null, ['label' => 'Número de Factura'])
                    ->add('formaPago', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('banco', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('idTransaccion',null, ['label' => 'ID de transacción'])
                    ->add('estatusPago', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                ->end()
            ->end()
            ->tab('Recepción')
                ->with('General')
                    ->add('fechaRecepcion', DateTimeType::class, ['label' => 'Fecha y Hora de Recepción', 'widget' => 'single_text','required' => false])
                    ->add('almacenaje', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('personaRecibio', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('observaciones',null, ['label' => 'Observaciones','required' => false])
                ->end()
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('fechaCompra')
            ->add('litros')
            ->add('precioLitro')
            ->add('iepsFactor')
            ->add('iepsTotal')
            ->add('iva')
            ->add('subtotal')
            ->add('total')
            ->add('fechaPago')
            ->add('numFactura')
            ->add('idTransaccion')
            ->add('fechaRecepcion')
            ->add('observaciones')
            ;
    }
}
