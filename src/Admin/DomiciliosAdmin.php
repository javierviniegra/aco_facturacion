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
            //->add('poblacion')
            ->add('municipio')
            //->add('estado')
            //->add('pais')
            ->add('estado1', ['label' => 'Estado'])
            ->add('pais1',  ['label' => 'País'])
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
            //->add('poblacion')
            ->add('municipio')
            //->add('estado')
            //->add('pais')
            ->add('estado1', ['label' => 'Estado'])
            ->add('pais1',  ['label' => 'País'])
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
                ->with('Entrega', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('Dirección')
                ->with('Entrega')
                    ->add('nombre')
                    ->add('TipoDomicilio', ModelType::class, [
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Tipo de Domicilio'
                    ])
                    ->add('georeferencia', null, ['required' => false,'label' => 'Georeferencia (ej. 41.40338; 2.17403)'])
                    ->add('calle',null,['label' => 'Calle'])
                    ->add('numExterior',null,['label' => '# Exterior'])
                    ->add('numInterior',null,['label' => '# Interior'])
                    ->add('colonia',null,['label' => 'Colonia'])
                    ->add('codigoPostal',null,['label' => 'C.P.'])
                    //->add('poblacion',null,['label' => 'Población'])
                    ->add('alcaldia', ModelType::class, [
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Alcaldía o Municipio'
                    ])
                    //->add('estado',null,['label' => 'Estado'])
                    //->add('pais',null,['label'=>'País'])
                    ->add('estado1', null, ['required' => true,'label' => 'Estado'])
                    ->add('pais1', null, ['required' => true,'label' => 'País'])
                    //->add('nacionalidad',null,['label' => 'Nacionalidad'])
                    ->add('telefono1',null,['label' => 'Teléfono 1'])
                    ->add('telefono2',null,['label' => 'Teléfono 2'])
                    ->add('observaciones',null,['label' => 'Observaciones'])
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
            //->add('poblacion')
            ->add('municipio')
            //->add('estado')
            //->add('pais')
            ->add('nacionalidad')
            ->add('telefono1')
            ->add('telefono2')
            ->add('observaciones')
            ;
    }
}
