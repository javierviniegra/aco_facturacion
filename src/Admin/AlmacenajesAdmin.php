<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Sonata\AdminBundle\Form\Type\ModelType;

final class AlmacenajesAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('combustible')
            ->add('capacidad')
            ->add('total')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_active')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre')
            ->add('combustible')
            ->add('capacidad')
            ->add('total')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_active')
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
            ->tab('General')
                ->with('Others', ['class' => 'col-md-12'])->end()
            ->end();

        $form
            ->tab('General')
                ->with('Others')
                    ->add('nombre')
                    ->add('combustible', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('total', NumberType::class, [
                        'label' => 'Total',
                        'required' => false,
                        'grouping' => true,
                        'scale' => 2
                    ])
                    ->add('capacidad', NumberType::class, [
                        'label' => 'Cap??cidad M??xima',
                        'required' => false,
                        'grouping' => true,
                        'scale' => 2
                    ])
                    ->add('alerta_minimo', NumberType::class, [
                        'label' => 'Alerta M??nimo',
                        'required' => false,
                        'grouping' => true,
                        'scale' => 2
                    ])
                    ->add('alerta_maximo', NumberType::class, [
                        'label' => 'Alerta M??ximo',
                        'required' => false,
                        'grouping' => true,
                        'scale' => 2
                    ])
                ->end()
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->tab('General')
                ->with('Others', ['class' => 'col-md-12'])->end()
            ->end();

        $show
            ->tab('General')
                ->with('Others')
                    ->add('nombre')
                    ->add('combustible')
                    ->add('total', NumberType::class, [
                        'label' => 'Total'
                    ])
                    ->add('capacidad', NumberType::class, [
                        'label' => 'Cap??cidad M??xima'
                    ])
                    ->add('alerta_minimo', NumberType::class, [
                        'label' => 'Alerta M??nimo'
 
                    ])
                    ->add('alerta_maximo', NumberType::class, [
                        'label' => 'Alerta M??ximo'
 
                    ])
                ->end()
            ->end();
    }
}
