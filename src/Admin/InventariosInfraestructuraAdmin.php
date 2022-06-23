<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\DateTimePickerType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class InventariosInfraestructuraAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('is_active')
            ->add('tipo_camion')
            ->add('modelo')
            ->add('capacidad')
            ->add('domos')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('unidad')
            ->add('tipo_camion',null,['label'=>'Tipo de Camión'])
            ->add('modelo')
            ->add('capacidad')
            ->add('domos')
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
            ->tab('Unidad')
                ->with('Datos', ['class' => 'col-md-6'])->end()
                ->with('Factura', ['class' => 'col-md-6'])->end()
                ->with('Seguro', ['class' => 'col-md-12'])->end()
                ->with('Tarjeta de Circulación', ['class' => 'col-md-12'])->end()
                ->with('Verificaciones', ['class' => 'col-md-12'])->end()
                ->with('Tenencias', ['class' => 'col-md-12'])->end()
                ->with('Otros', ['class' => 'col-md-12'])->end()
            ->end();

        $form
            ->tab('Unidad')
                ->with('Datos')
                    ->add('is_active')
                    ->add('id_transporte',null,['label'=>'ID del Transporte'])
                    ->add('tipo_camion', ModelType::class, [
                            'label' => 'Tipo de Camión',
                            'required' => true,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('unidad')
                    ->add('serie',null,['label'=>'# de Serie'])
                    ->add('permiso_sct',null,['label'=>'# de Permiso SCT'])
                    ->add('modelo')
                    ->add('placa',null,['label'=>'# de Placa'])
                    ->add('capacidad')
                    ->add('domos',null,['label'=>'# de Domos'])
                ->end()
                ->with('Factura')
                    ->add('facturaField',null,['label'=>'# de Factura'])
                    ->add('facturaFile', VichFileType::class, ['required' => false,'label' => 'Factura (PDF)'])
                ->end()
                ->with('Seguro')
                    ->add('SeguroAuto', AdminType::class, [
                        'label' => false,
                    ])
                ->end()
                ->with('Tarjeta de Circulación')
                    ->add('tarjeta_circulacion', AdminType::class, [
                        'label' => false,

                        'attr'               => array(
                            'class' => 'form-productos'
                        )                    ])
                ->end()
                ->with('Verificaciones')
                    ->add('verificaciones', CollectionType::class, [
                        'by_reference' => true,
                        'label' => false,
                        'attr'               => array(
                            'class' => 'form-verificaciones'
                        )
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ])
                ->end()
                ->with('Tenencias')
                    ->add('tenencias', CollectionType::class, [
                        'by_reference' => false,
                        'label' => false,
                        'attr'               => array(
                            'class' => 'form-tenencias'
                        )
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ])
                ->end()
                ->with('Otros')
                    ->add('equipo_especial')
                    ->add('observaciones')
                ->end()
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->tab('Unidad')
                ->with('Datos', ['class' => 'col-md-6'])->end()
                ->with('Factura', ['class' => 'col-md-6'])->end()
                ->with('Seguro', ['class' => 'col-md-12'])->end()
                ->with('Tarjeta de Circulación', ['class' => 'col-md-12'])->end()
                ->with('Verificaciones', ['class' => 'col-md-12'])->end()
                ->with('Tenencias', ['class' => 'col-md-12'])->end()
                ->with('Otros', ['class' => 'col-md-12'])->end()
            ->end();

        $show
            ->tab('Unidad')
                ->with('Datos')
                    ->add('is_active')
                    ->add('id_transporte',null,['label'=>'ID del Transporte'])
                    ->add('tipo_camion', null, ['label' => 'Tipo de Camión'])
                    ->add('unidad')
                    ->add('serie',null,['label'=>'# de Serie'])
                    ->add('permiso_sct',null,['label'=>'# de Permiso SCT'])
                    ->add('modelo')
                    ->add('placa',null,['label'=>'# de Placa'])
                    ->add('capacidad')
                    ->add('domos',null,['label'=>'# de Domos'])
                ->end()
                ->with('Factura')
                    ->add('facturaField',null,['label'=>'# de Factura'])
                    ->add('facturaFile', VichFileType::class, ['required' => false,'label' => 'Factura (PDF)'])
                ->end()
                ->with('Seguro')
                    ->add('SeguroAuto', null, ['label' => false,'template' => 'CRUD/show_field_inv_segurosauto.html.twig'])
                ->end()
                ->with('Tarjeta de Circulación')
                    ->add('tarjeta_circulacion',null,['template' => 'CRUD/show_field_inv_tarjetacirculacion.html.twig'])
                ->end()
                ->with('Verificaciones')
                    ->add('verificaciones',null,['template' => 'CRUD/show_field_inv_verificaciones.html.twig'])
                ->end()
                ->with('Tenencias')
                    ->add('tenencias',null,['template' => 'CRUD/show_field_inv_tenencias.html.twig'])
                ->end()
                ->with('Otros')
                    ->add('equipo_especial')
                    ->add('observaciones')
                ->end()
            ->end()
            ;
    }
}

