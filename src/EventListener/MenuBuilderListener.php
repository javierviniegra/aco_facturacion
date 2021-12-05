<?php

namespace App\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;
use Symfony\Component\Security\Core\Security;

class MenuBuilderListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $menu->removeChild("sonata_user");
        $menu->removeChild("Administración");


        $child = $menu->addChild('registro_clave_menu', [
            'label' => 'Administración',
            'route' => 'registro_clave',
        ])->setExtras([
            'icon' => '<i class="fa fa-book"></i>',
            'orderNumber' => 0,
        ]);
        $child = $menu->getChild("registro_clave_menu");
        $child->addChild('registro_clave',[
            'label'=> ucfirst(mb_strtolower('Registro de Claves')),
            'route'=>'admin_app_regisroclave_list'
        ]);
        if($this->security->isGranted('ROLE_SUPER_ADMIN'))
        {
            $child = $menu->addChild('sonata_user', [
                'label' => 'Users',
            ])->setExtras([
                'icon' => '<i class="fa fa-users"></i>'
            ]);
            $child = $menu->getChild('sonata_user');
            $child->addChild('Users', [
                'route' => 'admin_app_sonatauseruser_list'
            ]);
            $child->addChild('Groups', [
                'route' => 'admin_app_sonatausergroup_list'
            ]);
        }
    }
}