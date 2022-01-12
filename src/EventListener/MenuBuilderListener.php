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
        $menu->removeChild("admin");
        $menu->removeChild("Administración");

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
            //los catalogos
            $child = $menu->addChild('catalogos', [
                'label' => 'Catálogos',
            ])->setExtras([
                'icon' => '<i class="fa fa-book"></i>',
                'orderNumber' => 0,
            ]);
            $child = $menu->getChild("catalogos");
            $child->addChild('catalogos_puesto',[
                'label'=> ucfirst(mb_strtolower('Puestos')),
                'route'=>'admin_app_puesto_list'
            ]);
            $child->addChild('catalogos_tiposangre',[
                'label'=> ucfirst(mb_strtolower('Tipo de Sangre')),
                'route'=>'admin_app_tiposangre_list'
            ]);
            $child->addChild('catalogos_estadocivil',[
                'label'=> ucfirst(mb_strtolower('Estado Civil')),
                'route'=>'admin_app_estadocivil_list'
            ]);
        }
    }
}