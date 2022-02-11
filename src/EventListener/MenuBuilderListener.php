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
        $menu->removeChild("Catálogos");
        $menu->removeChild("Administración");

        if($this->security->isGranted('ROLE_SUPER_ADMIN'))
        {
            $child = $menu->addChild('dashboard', [
                'route' => 'sonata_admin_dashboard',
                'label' => 'AI ACO (Dashboard)',
            ])->setExtras([
                'icon' => '<i class="fa fa-bars"></i>'
            ]);

            $child = $menu->addChild('Clientes',[
                'route'=>'admin_app_clientes_list'
            ])->setExtras(['icon' => '<i class="fa fa-vcard"></i>']);
            $child = $menu->addChild('Proveedores')->setExtras(['icon' => '<i class="fa fa-shopping-cart"></i>']);
            $child = $menu->addChild('Inventarios')->setExtras(['icon' => '<i class="fa fa-calculator"></i>']);
            $child = $menu->addChild('Compras')->setExtras(['icon' => '<i class="fa fa-shopping-bag"></i>']);
            $child = $menu->addChild('Ventas')->setExtras(['icon' => '<i class="fa fa-truck"></i>']);

            $child = $menu->addChild('sonata_user', [
                'label' => 'RRHH',
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
            $child->addChild('catalogos', [
                'label' => 'Catálogos',
            ])->setExtras([
                'icon' => '<i class="fa fa-book"></i>',
                'orderNumber' => 0,
            ]);
            $child = $child->getChild("catalogos");
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

            $child = $menu->addChild('Reportes')->setExtras(['icon' => '<i class="fa fa-bar-chart"></i>']);

        }
    }
}