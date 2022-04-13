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
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

final class ProveedoresAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre',null,['label' => 'Nombre Comercial'])
            ->add('rfc',null,['label' => 'RFC'])
            ->add('razonSocial',null,['label' => 'Razón Social'])
            ->add('razon',null,['label' => 'Persona'])
            ->add('is_active',null,['label' => 'Activo?'])
            ->add('telefono1',null,['label' => 'Teléfono 1'])
            /*->add('nombre')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_active')
            ->add('rfc')
            ->add('razonSocial')
            ->add('razon')
            ->add('calle')
            ->add('numInterior')
            ->add('numExterior')
            ->add('colonia')
            ->add('cp')
            ->add('municipio')
            ->add('estado')
            ->add('pais')
            ->add('nacionalidad')
            ->add('telefono1')
            ->add('telefono2')
            ->add('manejoCredito')
            ->add('limiteCredito')
            ->add('diasCredito')
            ->add('cuentaContable1')
            ->add('cuentaContable2')
            ->add('porcentajeDescuento')
            ->add('observaciones')*/
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre',null,['label' => 'Nombre Comercial'])
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
            ->tab('General')
                ->with('Profile', ['class' => 'col-md-6'])->end()
                ->with('Status', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Domicilio')
                ->with('Domicilio Fiscal', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Contacto')
                ->with('Contactos', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Compras')
                ->with('Crédito', ['class' => 'col-md-6'])->end()
                ->with('Bancario', ['class' => 'col-md-6'])->end()
            ->end();

        $form
            ->tab('General')
                ->with('Profile')
                    ->add('nombre',null,['label' => 'Nombre Comercial'])
                    ->add('rfc',null,['label' => 'RFC'])
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
                    ->add('razonSocial',null,['label' => 'Razón Social'])
                    ->add('webpage',null,['label' => 'Página Web'])
                ->end()
                ->with('Status')
                    ->add('is_active')
                ->end()
            ->end()
            ->tab('Domicilio')
                ->with('Domicilio Fiscal')
                    ->add('calle',null,['label' => 'Calle'])
                    ->add('numInterior',null,['label' => 'Número Interior'])
                    ->add('numExterior',null,['label' => 'Número Exterior'])
                    ->add('colonia',null,['label' => 'Colonia'])
                    ->add('cp',null,['label' => 'C.P.'])
                    ->add('municipio',null,['label' => 'Alcaldía o Municipio'])
                    ->add('estado',null,['label' => 'Estado'])
                    ->add('nacionalidad',null,['label' => 'Nacionalidad'])
                    ->add('telefono1',null,['label' => 'Teléfono 1'])
                    ->add('telefono2',null,['label' => 'Teléfono 2'])
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
            ->end()
            ->tab('Compras')
                ->with('Crédito')
                    ->add('manejoCredito',null,['label' => 'Maneja Crédito'])
                    ->add('limiteCredito', MoneyType::class, [
                        'currency' => 'MXP',
                        'divisor' => 100,
                        'label' => 'Límite de Crédito'
                    ])
                    ->add('diasCredito',null,['label' => 'Días de Crédito'])
                    ->add('porcentajeDescuento',PercentType::class,[
                        'label' => 'Porcentaje de Descuento',
                        'label_format' => 'penaltyRate',
                        'scale'=>2,
                        'type'=>'integer'])
                    ->add('observaciones',null,['label' => 'Observaciones'])
                ->end()
                ->with('Bancario') 
                    ->add('banco1', ModelType::class, [
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Banco 1'
                    ])
                    ->add('cuentaContable1',null,['label' => 'Cuenta Contable 1'])   
                    ->add('banco2', ModelType::class, [
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Banco 2'
                    ])
                    ->add('cuentaContable2',null,['label' => 'Cuenta Contable 2'])
                ->end()
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nombre')
            ->add('created_at')
            ->add('updated_at')
            ->add('is_active')
            ->add('rfc')
            ->add('razonSocial')
            ->add('razon')
            ->add('calle')
            ->add('numInterior')
            ->add('numExterior')
            ->add('colonia')
            ->add('cp')
            ->add('municipio')
            ->add('estado')
            ->add('pais')
            ->add('nacionalidad')
            ->add('telefono1')
            ->add('telefono2')
            ->add('manejoCredito')
            ->add('limiteCredito')
            ->add('diasCredito')
            ->add('cuentaContable1')
            ->add('cuentaContable2')
            ->add('porcentajeDescuento')
            ->add('observaciones')
            ;
    }
}
