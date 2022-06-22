<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

final class TenenciasAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('monto', 'currency', ['currency' => 'MXN'])
            ->add('fecha','date')
            ->add('created_at','datetime')
            ->add('updated_at','datetime')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('monto', 'currency', ['currency' => 'MXN'])
            ->add('fecha','date')
            ->add('created_at','datetime')
            ->add('updated_at','datetime')
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
            ->tab('Tarjeta')
                ->with('Información', ['class' => 'col-md-6'])->end()
                ->with('Comprobante', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('Tarjeta')
                ->with('Información')
                    ->add('monto', MoneyType::class, [
                        'currency' => 'MXN',
                        'label' => 'Monto',
                        'grouping' => true,
                        'scale' => 2
                    ])
                    ->add('fecha', DatePickerType::class, ['label' => 'Fecha','format' => 'dd.MM.yyyy HH:mm','required' => true,'dp_use_current'    => true])
                    ->add('fotografiaFile', VichImageType::class, ['required' => false,'label' => 'Comprobante (PDF)'])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('monto', MoneyType::class, ['label' => 'Monto','template' => 'CRUD/show_field_moneda.html.twig'])
            ->add('fecha', DatePickerType::class)
            ->add('fotografia',null,['label'=>'Comprobante'])
            ->add('created_at', DateTimePickerType::class)
            ->add('updated_at', DateTimePickerType::class)
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
