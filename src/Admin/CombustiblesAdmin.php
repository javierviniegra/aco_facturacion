<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class CombustiblesAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('precio')
            ->add('created_at')
            ->add('updated_at')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre')
            ->add('precio', 'currency', ['currency' => 'MXN'])
            ->add('combustible_file',null,['label'=>'Image','template'=>'CRUD/list_field_vichimage_combustible.html.twig'])
            ->add('created_at')
            ->add('updated_at')
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
                ->with('Others', ['class' => 'col-md-6'])->end()
                ->with('Image', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('General')
                ->with('Others')
                    ->add('nombre')
                    ->add('precio', MoneyType::class, [
                        'currency' => 'MXN',
                        'label' => 'IVA',
                        'grouping' => true,
                        'scale' => 2
                    ])
                ->end()
                ->with('Image')
                    ->add('combustible_file', VichImageType::class, ['required' => false,'label' => 'Imagen (JPEG, GIF, PNG)'])
                ->end()
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->tab('General')
                ->with('Others', ['class' => 'col-md-6'])->end()
                ->with('Image', ['class' => 'col-md-6'])->end()
            ->end();

        $show
            ->tab('General')
                ->with('Others')
                    ->add('nombre')
                    ->add('precio',null,['label' => 'Precio','template'=>'CRUD/show_field_moneda.html.twig'])
                ->end()
                ->with('Image')
                    ->add('combustible_file',null,['label' => false,'template'=>'CRUD/show_field_vichimage_combustible.html.twig'])
                ->end()
            ->end();
    }
}
