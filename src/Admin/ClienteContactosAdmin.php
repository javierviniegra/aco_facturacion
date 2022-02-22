<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class ClienteContactosAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('puesto')
            ->add('telefono1')
            ->add('telefono2')
            ->add('celular')
            ->add('email')
            ->add('observaciones')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre')
            ->add('puesto')
            ->add('telefono1')
            ->add('telefono2')
            ->add('celular')
            ->add('email')
            ->add('observaciones')
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
                ->with('Profile', ['class' => 'col-md-6'])->end()
                ->with('Others', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('General')
                ->with('Profile')                    
                    ->add('nombre')
                    ->add('puesto')
                    ->add('telefono1')
                    ->add('telefono2')
                    ->add('celular')
                    ->add('email')
                ->end()
                ->with('Others')              
                    ->add('observaciones')
                ->end()
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nombre')
            ->add('puesto')
            ->add('telefono1')
            ->add('telefono2')
            ->add('celular')
            ->add('email')
            ->add('observaciones')
            ;
    }
}
