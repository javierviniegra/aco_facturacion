<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;


final class SalarioAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('monto')
            ->add('fecha')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('monto')
            ->add('fecha')
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
            ->add('monto', MoneyType::class, [
                'currency' => 'MXP',
                'divisor' => 100,
            ])
            ->add('fecha', DateType::class, [
                        'widget' => 'single_text',
                        'required' => true
                    ])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('monto')
            ->add('fecha')
            ;
    }
}
