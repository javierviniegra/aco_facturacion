<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class RegisroClaveAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('clave')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('nombre')
            ->add('clave')
            ->add('is_valid')
            ->add('crated_at')
            ->add('updated_at')
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
            ->add('nombre')
            ->add('clave')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nombre')
            ->add('clave')
            ->add('is_valid')
            ->add('crated_at')
            ->add('updated_at')
            ;
    }

    public function getNewInstance()
    {
        $object = parent::getNewInstance();

        //$object->setDefaults();

        $object->setClave($this->randomAlfanumerico(8));

        return $object;
    }

    private function randomAlfanumerico($longitud)
    {
        $key = '';
         $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $longitud; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
}
