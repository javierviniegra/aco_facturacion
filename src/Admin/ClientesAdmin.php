<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelType;

final class ClientesAdmin extends AbstractAdmin
{


    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombreComercial',null,['label' => 'Nombre Comercial'])
            ->add('rfc',null,['label' => 'RFC'])
            ->add('razonSocial',null,['label' => 'Razón Social'])
            ->add('razon',null,['label' => 'Persona'])
            ->add('is_active',null,['label' => 'Activo?'])
            ->add('telefono1',null,['label' => 'Teléfono 1'])
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombreComercial',null,['label' => 'Nombre Comercial'])
            ->add('rfc',null,['label' => 'RFC'])
            ->add('razonSocial',null,['label' => 'Razón Social'])
            ->add('razon',null,['label' => 'Persona'])
            ->add('is_active',null,['label' => 'Activo?'])
            ->add('telefono1',null,['label' => 'Teléfono 1'])
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
            ->tab('Cliente')
                ->with('Profile', ['class' => 'col-md-6'])->end()
                ->with('Status', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Domicilio')
                ->with('Domicilios', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Administrativo')
                ->with('SAT', ['class' => 'col-md-6'])->end()
                ->with('Crédito', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Contacto')
                ->with('Contactos', ['class' => 'col-md-12'])->end()
            ->end();

        $form
            ->tab('Cliente')
                ->with('Profile')
                    ->add('rfc',null,['label' => 'RFC'])
                    ->add('nombreComercial',null,['label' => 'Nombre Comercial'])
                    ->add('razonSocial',null,['label' => 'Razón Social'])
                    ->add('razon',ChoiceType::class,[
                        'label' => 'Persona',
                        'multiple' => false,
                        'sortable' => true,
                        'choices' => [
                            'Física' => 1,
                            'Moral' => 2,
                        ],
                        'label_attr' => array('class' => 'checkbox-inline'),
                    ])
                ->end()
                ->with('Status')
                    ->add('is_active')
                ->end()
            ->end()
            ->tab('Administrativo')
                ->with('SAT')
                    ->add('usoCfdi', ModelType::class, [
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Uso del CFDI'
                    ])
                    /*->add('formas_pago', ModelType::class, [
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Forma de Pago'
                    ])*/
                    //->add('numRegistro',null,['label' => 'Número de Registro Tributario'])
                    ->add('email1_factura',null,['label' => 'Email para envío de Facturas 1'])
                    ->add('email2_factura',null,['label' => 'Email para envío de Facturas 2'])
                    ->add('email3_factura',null,['label' => 'Email para envío de Facturas 3'])
                ->end()
                ->with('Crédito')
                    ->add('diasCredito',null,['label' => 'Días de Crédito'])
                ->end()
            ->end()
            ->tab('Domicilio')
                ->with('Domicilios')
                    ->add('domicilio', CollectionType::class, [
                        'by_reference' => false,
                        'required' => true,
                        'label' => 'Listado de Domicilios'
                    ],
                    [
                        'edit' => 'inline',
                        //'inline' => 'table'
                    ])
                ->end()
            ->end()
            ->tab('Contacto')
                ->with('Contactos')
                    ->add('contactos', CollectionType::class, [
                        'by_reference' => false,
                        'required' => true,
                        'label' => 'Listado de Contactos'
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ])
                ->end()
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('rfc')
            ->add('nombreComercial')
            ->add('razonSocial')
            ->add('razon')
            ->add('is_active')
            ;
    }
}
