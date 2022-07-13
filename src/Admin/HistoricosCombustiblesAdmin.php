<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

final class HistoricosCombustiblesAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('combustible')
            ->add('valor')
            ->add('usuario')
            ->add('created_at')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('combustible')
            ->add('valor')
            ->add('usuario')
            ->add('created_at')
            ;
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('valor')
            ->add('created_at')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('valor')
            ->add('created_at')
            ;
    }
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('edit');
        $collection->remove('delete');
        $collection->remove('export');
        $collection->remove('create');
    }
}
