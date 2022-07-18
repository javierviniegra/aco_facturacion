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
use Sonata\Form\Type\DateTimePickerType;
use App\Repository\VentasRepository;

final class VentasAdmin extends AbstractAdmin
{
    protected $em;

    public function __construct($code, $class, $baseControllerName, $entityManager)
    {
         parent::__construct($code, $class, $baseControllerName);
         $this->em = $entityManager;
    }


    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id_venta')
            //->add('fecha',DateType::class, ['widget' => 'single_text','required' => true])
            ->add('id_factura')
            ->add('serie')
            ->add('folio')
            ->add('rfc',null,['label'=>'Cliente'])
            ->add('fechaFactura')
            ->add('tipoEntrega')
            ->add('id_pedido')
            ->add('id_camion')
            ->add('quienEntrega')
            ->add('dondeEntrega')
            ->add('id_cinturon')
            ->add('fechaEntrega')
            ->add('quienRecibe')
            ->add('ordenCompletada')
            ->add('created_at')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id_venta')
            ->add('fecha')
            ->add('rfc',null,['label'=>'Cliente'])
            ->add('ordenCompletada',null,['label' => 'Orden Completada'])
            ->add('created_at')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $repository = $this->em->getRepository('App:Ventas');
        if (!empty($repository->findLastVentaID()))
            $elLastID = str_pad(strval($repository->findLastVentaID()[0]->getId()+1),7,"0",STR_PAD_LEFT);
        else
            $elLastID = "0000001";

        // define group zoning
        $form
            ->tab('Ventas')
                ->with('Ventas', ['class' => 'col-md-12'])->end()
                ->with('Productos', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación', ['class' => 'col-md-6'])->end()
                ->with('Pagos', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Entrega')
                ->with('Entrega', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Flete')
                ->with('Flete', ['class' => 'col-md-12'])->end()
            ->end();

        $now = new \DateTime();

        if($this->getSubject()->getId() === null)
            $form
                ->tab('Ventas')
                    ->with('Ventas')
                        ->add('id_venta',null,[
                            'label' => 'ID de Venta',
                            'required' => true,
                            'disabled'  => false,
                            'data' => "OV".date("Y")."-".$elLastID,
                            'attr' => array(
                                'readonly' => true,
                            )
                        ])
                    ->end()
                ->end();
        else
            $form
                ->tab('Ventas')
                    ->with('Ventas')
                        ->add('id_venta',null,[
                            'label' => 'ID de Venta',
                            'required' => true,
                            'disabled'  => false,
                            'attr' => array(
                                'readonly' => true,
                            )
                        ])
                    ->end()
                ->end();
        $form
            ->tab('Ventas')
                ->with('Ventas')
                    ->add('id_venta',null,['label' => 'ID de Venta','required' => true])
                    ->add('fecha', DateType::class, ['label' => 'Fecha de Venta', 'widget' => 'single_text','required' => true])
                    ->add('rfc',ModelType::class,['label'=>'Cliente'])
                    ->add('flete',MoneyType::class, [
                        'currency' => 'MXN',
                        'label' => 'Precio del Flete',
                        'grouping' => true,
                        'scale' => 2
                    ])
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
                ->with('Pagos')
                    ->add('formaPago',ModelType::class,['label'=>'Forma de Pago'])
                    ->add('metodo_pago1',ModelType::class,['label'=>'Método de Pago'])
                ->end()
            ->end()
            ->tab('Entrega')
                ->with('Entrega')
                    ->add('quienEntrega',null,['label' => 'Persona que Entrega','required' => false])
                    ->add('dondeEntrega',null,['label' => 'Donde se Entrega','required' => false])
                    ->add('id_cinturon',null,['label' => 'ID del Cinturón','required' => false])
                    ->add('fechaEntrega', DateTimePickerType::class, ['label' => 'Fecha y Hora de Entrega','format'            => 'dd.MM.yyyy HH:mm','required' => true,'dp_use_current'    => false])
                    ->add('quienRecibe',null,['label' => 'Persona que Recibe','required' => false])
                    ->add('ordenCompletada',null,['label' => 'Orden Completada?','required' => false])
                    ->add('observacionesEntrega',null,['label' => 'Observaciones','required' => false])
                ->end()
            ->end()
            ->tab('Flete')
                ->with('Flete')
                    ->add('tipoEntrega',null,['label' => 'Tipo de Entrega','required' => false])
                    ->add('id_pedido',null,['label' => 'ID del Pedido','required' => false])
                    ->add('id_camion',null,['label' => 'ID del Camión','required' => false])
                    ->add('observacionesFlete',null,['label' => 'Observaciones','required' => false])
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
