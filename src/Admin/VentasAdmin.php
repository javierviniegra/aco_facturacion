<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

final class VentasAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id_venta')
            ->add('fecha')
            ->add('id_factura')
            ->add('serie')
            ->add('folio')
            ->add('fechaFactura')
            ->add('tipoEntrega')
            ->add('id_pedido')
            ->add('id_camion')
            ->add('observacionesFlete')
            ->add('quienEntrega')
            ->add('dondeEntrega')
            ->add('id_cinturon')
            ->add('fechaEntrega')
            ->add('quienRecibe')
            ->add('ordenCompletada')
            ->add('observacionesEntrega')
            ->add('created_at')
            ->add('updated_at')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id_venta')
            ->add('fecha')
            ->add('ordenCompletada',null,['label' => 'Orden Completada'])
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
        // define group zoning
        $form
            ->tab('Ventas')
                ->with('Ventas', ['class' => 'col-md-12'])->end()
                ->with('Productos', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Entrega')
                ->with('Entrega', ['class' => 'col-md-6'])->end()
                ->with('Flete', ['class' => 'col-md-6'])->end()
            ->end();

        $now = new \DateTime();

        $form
            ->tab('Ventas')
                ->with('Ventas')
                    ->add('id_venta',null,['label' => 'ID de Venta','required' => true])
                    ->add('fecha', DateType::class, ['label' => 'Fecha de Venta', 'widget' => 'single_text','required' => true])
                ->end()
                ->with('Productos')
                    ->add('productosVenta', CollectionType::class, [
                        'by_reference' => false,
                        'required' => false,
                        'label' => 'Productos'
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ])
                ->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación')
                    ->add('id_factura',null,['label' => 'ID de Factura','required' => false])
                    ->add('serie',null,['label' => 'Serie','required' => false])
                    ->add('folio',null,['label' => 'Folio','required' => false])
                    ->add('fechaFactura', DateType::class, ['label' => 'Fecha de Factura', 'widget' => 'single_text','required' => false])
                ->end()
            ->end()
            ->tab('Entrega')
                ->with('Entrega')
                    ->add('tipoEntrega',null,['label' => 'Tipo de Entrega','required' => false])
                    ->add('id_pedido',null,['label' => 'ID del Pedido','required' => false])
                    ->add('id_camion',null,['label' => 'ID del Camión','required' => false])
                    ->add('observacionesFlete',null,['label' => 'Observaciones','required' => false])
                    ->add('quienEntrega',null,['label' => 'Persona que Entrega','required' => false])
                    ->add('dondeEntrega',null,['label' => 'Donde se Entrega','required' => false])
                    ->add('id_cinturon',null,['label' => 'ID del Cinturón','required' => false])
                    ->add('fechaEntrega', DateTimeType::class, ['label' => 'Fecha y Hora de Entrega', 'widget' => 'single_text','required' => false])
                ->end()
                ->with('Flete')
                    ->add('quienRecibe',null,['label' => 'Persona que Recibe','required' => false])
                    ->add('ordenCompletada',null,['label' => 'Orden Completada?','required' => false])
                    ->add('observacionesEntrega',null,['label' => 'Observaciones','required' => false])
                ->end()
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id_venta')
            ->add('fecha')
            ->add('id_factura')
            ->add('serie')
            ->add('folio')
            ->add('fechaFactura')
            ->add('tipoEntrega')
            ->add('id_pedido')
            ->add('id_camion')
            ->add('observacionesFlete')
            ->add('quienEntrega')
            ->add('dondeEntrega')
            ->add('id_cinturon')
            ->add('fechaEntrega')
            ->add('quienRecibe')
            ->add('ordenCompletada')
            ->add('observacionesEntrega')
            ->add('created_at')
            ->add('updated_at')
            ;
    }
}