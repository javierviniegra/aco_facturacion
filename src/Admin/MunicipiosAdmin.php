<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class MunicipiosAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('estado')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre')
            ->add('estado')
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
            ->add('nombre')
            ->add('estado')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nombre')
            ;
    }
}
