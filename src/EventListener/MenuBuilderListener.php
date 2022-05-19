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
        $menu->removeChild("RRHH");

            $child = $menu->addChild('dashboard', [
                'route' => 'sonata_admin_dashboard',
                'label' => 'AI ACO (Dashboard)',
            ])->setExtras([
                'icon' => '<i class="fa fa-bars"></i>'
            ]);
            $child = $menu->addChild('dashboard1', [
                'route' => 'dashboard1',
                'label' => 'AI ACO (Dashboard #2)',
            ])->setExtras([
                'icon' => '<i class="fa fa-bars"></i>'
            ]);
            $child = $menu->addChild('Controles Volumétricos',[
                'label'=> 'Controles Volumétricos',
                'route'=>'cont_volumetricos'
            ])->setExtras(['icon' => '<i class="fa fa-thermometer-0"></i>']);
            $child = $menu->addChild('Clientes',[
                'label'=> 'Clientes',
                'route'=>'admin_app_clientes_list'
            ])->setExtras(['icon' => '<i class="fa fa-vcard"></i>']);
            $child = $menu->addChild('Proveedores',[
                'label'=> 'Proveedores',
                'route'=>'admin_app_proveedores_list'
            ])->setExtras(['icon' => '<i class="fa fa-shopping-cart"></i>']);
            $child = $menu->addChild('Inventarios')->setExtras(['icon' => '<i class="fa fa-calculator"></i>']);
            $child1 = $menu->getChild("Inventarios");
            $child1->addChild('productos',[
                'label'=> 'Productos',
                'route'=>'admin_app_productos_list'
            ]);
            $child = $menu->addChild('Compras',[
                'label'=> 'Compras',
                'route'=>'admin_app_compras_list'
            ])->setExtras(['icon' => '<i class="fa fa-shopping-bag"></i>']);
            $child = $menu->addChild('Ventas',[
                'label'=> 'Ventas',
                'route'=>'admin_app_ventas_list'
            ])->setExtras(['icon' => '<i class="fa fa-truck"></i>']);

            $child = $menu->addChild('sonata_user', [
                'label' => 'RRHH',
                'route' => 'admin_app_sonatauseruser_list'
            ])->setExtras([
                'icon' => '<i class="fa fa-users"></i>'
            ]);

            $child = $menu->addChild('Reportes')->setExtras(['icon' => '<i class="fa fa-bar-chart"></i>']);

    }
}