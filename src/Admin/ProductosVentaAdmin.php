<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\Type\ModelType;

final class ProductosVentaAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('litros')
            ->add('precioLitro')
            ->add('precioFlete')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('producto')
            ->add('litros')
            ->add('precioLitro')
            ->add('precioFlete')
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
            ->add('producto',ModelType::class)
            ->add('litros', NumberType::class, ['label' => 'Cantidad','required' => true])
            ->add('precioLitro', MoneyType::class, [
                        'currency' => 'MXP',
                        'divisor' => 100,
                        'label' => 'Precio',
                        'required' => true
                    ])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('litros')
            ->add('precioLitro')
            ->add('precioFlete')
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
