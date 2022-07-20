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
use Sonata\AdminBundle\Route\RouteCollection;

final class ProductosVentaAdmin extends AbstractAdmin
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
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
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
            ->add('retencion', MoneyType::class, [
                'currency' => 'MXN',
                'label' => 'Retención',
                'required' => false,
                'grouping' => true,
                'scale' => 2
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
            ->tab('Producto')
                ->with('Valor', ['class' => 'col-md-6'])->end()
                ->with('Impuestos', ['class' => 'col-md-6'])->end()
            ->end();

        $show
            ->tab('Producto')
                ->with('Valor')
                    ->add('producto',null,['label' => 'Producto'])
                    ->add('litros',null,['label' => 'Cantidad'])
                    ->add('precioLitro',null,['label' => 'Precio','template'=>'CRUD/show_field_moneda.html.twig'])
                    ->add('subtotal',null,['label' => 'SubTotal','template'=>'CRUD/show_field_moneda.html.twig'])
                    ->add('retencion',null,['label' => 'Retención','template'=>'CRUD/show_field_moneda.html.twig'])
                    ->add('total',null,['label' => 'Total','template'=>'CRUD/show_field_moneda.html.twig'])
                ->end()
                ->with('Impuestos')
                    ->add('requiereIeps',null,['label' => 'Requiere Ieps'])
                    ->add('factorIeps',null,['label' => 'Factor'])
                    ->add('totalIeps',null,['label' => 'Total','template'=>'CRUD/show_field_moneda.html.twig'])
                    ->add('iva',null,['label' => 'IVA','template'=>'CRUD/show_field_moneda.html.twig'])
                ->end()
            ->end()
            ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('edit');
        $collection->remove('delete');
        $collection->remove('export');
        $collection->remove('list');
    }
}
