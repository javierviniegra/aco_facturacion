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

final class SegurosAutoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('numero',null,['label'=>'Número de Póliza'])
            ->add('vigencia','date')
            ->add('created_at','datetime')
            ->add('updated_at','datetime')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('numero',null,['label'=>'Número de Póliza'])
            ->add('vigencia','date')
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
            ->tab('Póliza')
                ->with('Información', ['class' => 'col-md-6'])->end()
                ->with('Fotografía', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('Póliza')
                ->with('Información')
                    ->add('numero',null,['label'=>'Número de Póliza','required'=>true])
                    ->add('vigencia', DatePickerType::class, ['label' => 'Vigencia','format' => 'dd.MM.yyyy','required' => true,'dp_use_current'    => false])
                ->end()
                ->with('Fotografía')
                    ->add('fotografiaFile', VichImageType::class, ['required' => false,'label' => 'Fotografía (PDF)','allow_file_upload'=>true,'allow_delete'=>true,'by_reference'=>true])
                ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('numero',null,['label'=>'Número de Póliza'])
            ->add('vigencia', DatePickerType::class)
            ->add('fotografia',null,['label'=>'Fotografía'])
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
