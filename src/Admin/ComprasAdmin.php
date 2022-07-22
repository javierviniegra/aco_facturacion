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
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use App\Repository\ComprasRepository;

final class ComprasAdmin extends AbstractAdmin
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
            ->add('fechaCompra')
            ->add('id_compra')
            ->add('proveedor')
            ->add('total')
            ->add('fechaPago')
            ->add('numFactura')
            ->add('idTransaccion')
            ->add('observaciones')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('fechaCompra','datetime')
            ->add('id_compra')
            ->add('proveedor',ModelType::class)
            ->add('subtotal', 'currency', ['currency' => 'MXN'])
            ->add('total', 'currency', ['currency' => 'MXN'])
            ->add('fechaPago','datetime')
            ->add('numFactura')
            //->add('idTransaccion')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'recepcion' => [
                        'template' => 'CRUD/list__action_recepcion.html.twig',
                    ],
                    'show' => [],
                    'edit' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $repository = $this->em->getRepository('App:Compras');
        $primero = false;
        if (!empty($repository->findLastCompraID()))
            $elLastID = str_pad(strval($repository->findLastCompraID()[0]->getId()+1),7,"0",STR_PAD_LEFT);
        else{
            $primero = true;
            $elLastID = "0000001";
        }

        // define group zoning
        $form
            ->tab('Compras')
                ->with('Compras', ['class' => 'col-md-6'])->end()
                ->with('Cálculos', ['class' => 'col-md-6'])->end()
                ->with('Productos', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación', ['class' => 'col-md-6'])->end()
            ->end();

        $now = new \DateTime(); 
        
        if($this->getSubject()->getId() === null || $primero == true)
            $form
                ->tab('Compras')
                    ->with('Compras')
                        ->add('id_compra',null,[
                            'label' => 'ID de Compra',
                            'required' => true,
                            'disabled'  => false,
                            'data' => "CC".date("Y")."-".$elLastID,
                            'attr' => array(
                                'readonly' => true,
                            )
                        ])
                    ->end()
                ->end();
        else
            $form
                ->tab('Compras')
                    ->with('Compras')
                        ->add('id_compra',null,[
                            'label' => 'ID de Compra',
                            'required' => true,
                            'disabled'  => false,
                            'attr' => array(
                                'readonly' => true,
                            )
                        ])
                    ->end()
                ->end();
        $form
            ->tab('Compras')
                ->with('Compras')
                    ->add('fechaCompra', DateTimePickerType::class, ['label' => 'Fecha de Compra','format'            => 'dd.MM.yyyy HH:mm','required' => true,'dp_use_current'    => false])
                    ->add('proveedor', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                ->end()
                ->with('Cálculos')
                    ->add('iepsTotal', MoneyType::class, [
                        'currency' => 'MXN',
                        'label' => 'IEPS Total',
                        'grouping' => true ,
                        'scale' => 6
                    ])
                    ->add('iva', MoneyType::class, [
                        'currency' => 'MXN',
                        'label' => 'IVA',
                        'grouping' => true,
                        'scale' => 6
                    ])
                    ->add('subtotal', MoneyType::class, [
                        'currency' => 'MXN',
                        'label' => 'Subtotal',
                        'grouping' => true,
                        'scale' => 6
                    ])
                    ->add('total', MoneyType::class, [
                        'currency' => 'MXN',
                        'label' => 'Total',
                        'grouping' => true,
                        'scale' => 6
                    ])
                ->end()
                ->with('Productos')
                    ->add('productos', CollectionType::class, [
                        'by_reference' => false,
                        'required' => true,
                        'label' => false,
                        'btn_add' => 'Agregar Producto',
                        'attr'               => array(
                            'class' => 'form-productos'
                        )
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ])
                ->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación')
                    ->add('fechaPago', DateTimePickerType::class, ['label' => 'Fecha de Pago','format'            => 'dd.MM.yyyy HH:mm','required' => false,'dp_use_current'    => false])
                    ->add('numFactura',null, ['label' => 'Número de Factura'])
                    ->add('identificador_envio',null, ['label' => 'Identificador de Envío', 'required' => false])
                    ->add('formaPago', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('banco', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                    ->add('idTransaccion',null, ['label' => 'ID de transacción'])
                    ->add('estatusPago', ModelType::class, [
                            'required' => false,
                            'expanded' => false,
                            'multiple' => false,
                    ])
                ->end()
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    { 

        $repository = $this->em->getRepository('App:Compras');
        $elLastID = str_pad(strval($repository->findLastCompraID()[0]->getId()+1),7,"0",STR_PAD_LEFT);

        // define group zoning
        $show
            ->tab('Compras')
                ->with('Compras', ['class' => 'col-md-6'])->end()
                ->with('Cálculos', ['class' => 'col-md-6'])->end()
                ->with('Productos', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación', ['class' => 'col-md-6'])->end()
            ->end();
        
        $show
            ->tab('Compras')
                ->with('Compras')
                    ->add('id_compra',null,['label' => 'ID de Compra'])
                ->end()
            ->end()
            ->tab('Compras')
                ->with('Compras')
                    ->add('fechaCompra', null, ['label' => 'Fecha de Compra'])
                    ->add('proveedor')
                ->end()
                ->with('Cálculos')
                    ->add('iepsTotal', MoneyType::class, ['label' => 'IEPS Total','template' => 'CRUD/show_field_moneda.html.twig'])
                    ->add('iva', MoneyType::class, ['label' => 'IVA','template' => 'CRUD/show_field_moneda.html.twig'])
                    ->add('subtotal', MoneyType::class, ['label' => 'Subtotal','template' => 'CRUD/show_field_moneda.html.twig'])
                    ->add('total', MoneyType::class, ['label' => 'Total','template' => 'CRUD/show_field_moneda.html.twig'])
                ->end()
                ->with('Productos')
                    ->add('productos', null, ['label' => 'Lista de Productos','template' => 'CRUD/show_field_compra_productos.html.twig'])
                ->end()
            ->end()
            ->tab('Facturación')
                ->with('Facturación')
                    ->add('fechaPago', null, ['label' => 'Fecha de Pago'])
                    ->add('numFactura',null, ['label' => 'Número de Factura'])
                    ->add('formaPago', ModelType::class, ['label' => 'Forma de Pago'])
                    ->add('banco', ModelType::class)
                    ->add('idTransaccion',null, ['label' => 'ID de transacción'])
                    ->add('estatusPago', ModelType::class, ['label' => 'Estatus de Pago'])
                ->end()
            ->end()
            ;
    }

    //https://symfony.com/bundles/SonataAdminBundle/current/cookbook/recipe_custom_action.html
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection
            ->add('recepcion', $this->getRouterIdParameter().'/recepcion')
            ->add('recepcionAlta', $this->getRouterIdParameter().'/recepcion/{id_prod}/alta')
            ->add('recepcionMostrar', $this->getRouterIdParameter().'/recepcion/{id_prod}/mostrar');
    }

    //override de la funcion del query que genera la lista
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $rootAlias = $query->getRootAliases()[0];

        $query->andWhere(
            $query->expr()->neq($rootAlias.'.is_deleted', ':deleted')
        );
        $query->orWhere(
            $query->expr()->isNull($rootAlias.'.is_deleted')
        );

        $query->setParameter(':deleted', '1');
        return $query;
    }

    //override de la funcion del query que genera el orden de la lista 
    protected function configureDefaultSortValues(array &$sortValues): void
    {
        $sortValues[DatagridInterface::PAGE] = 1;
        $sortValues[DatagridInterface::SORT_ORDER] = 'DESC';
        $sortValues[DatagridInterface::SORT_BY] = 'created_at';
    }

}
