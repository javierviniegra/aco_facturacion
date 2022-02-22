<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelType;

final class DomiciliosAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('calle')
            ->add('numExterior')
            ->add('numInterior')
            ->add('colonia')
            ->add('codigoPostal')
            ->add('poblacion')
            ->add('municipio')
            ->add('estado')
            ->add('pais')
            ->add('nacionalidad')
            ->add('telefono1')
            ->add('telefono2')
            ->add('observaciones')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre')
            ->add('calle')
            ->add('numExterior')
            ->add('numInterior')
            ->add('colonia')
            ->add('codigoPostal')
            ->add('poblacion')
            ->add('municipio')
            ->add('estado')
            ->add('pais')
            ->add('nacionalidad')
            ->add('telefono1')
            ->add('telefono2')
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
            ->tab('Dirección')
                ->with('Ubicación', ['class' => 'col-md-6'])->end()
                ->with('Profile', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('Dirección')
                ->with('Profile')
                    ->add('TipoDomicilio', ModelType::class, [
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Tipo de Domicilio'
                    ])
                    ->add('nombre')
                ->end()
                ->with('Ubicación')
                    ->add('calle')
                    ->add('numExterior')
                    ->add('numInterior')
                    ->add('colonia')
                    ->add('codigoPostal')
                    ->add('poblacion')
                    ->add('municipio')
                    ->add('estado')
                    ->add('pais')
                    ->add('nacionalidad')
                    ->add('telefono1')
                    ->add('telefono2')
                    ->add('observaciones')
                ->end()
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nombre')
            ->add('calle')
            ->add('numExterior')
            ->add('numInterior')
            ->add('colonia')
            ->add('codigoPostal')
            ->add('poblacion')
            ->add('municipio')
            ->add('estado')
            ->add('pais')
            ->add('nacionalidad')
            ->add('telefono1')
            ->add('telefono2')
            ->add('observaciones')
            ;
    }
}
