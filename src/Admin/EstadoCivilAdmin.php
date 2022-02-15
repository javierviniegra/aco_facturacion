<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class EstadoCivilAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_active')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_active')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->tab('General')
                ->with('Profile', ['class' => 'col-md-6'])->end()
                ->with('Status', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('General')
                ->with('Profile')
                    ->add('nombre')
                ->end()
                ->with('Status')
                    ->add('is_active')
                ->end()
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nombre')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_active')
            ;
    }
}
