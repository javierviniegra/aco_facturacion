<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class AlmacenajesAdmin extends AbstractAdmin
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
