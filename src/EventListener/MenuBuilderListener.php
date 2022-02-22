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

            $child = $menu->addChild('dashboard', [
                'route' => 'sonata_admin_dashboard',
                'label' => 'AI ACO (Dashboard)',
            ])->setExtras([
                'icon' => '<i class="fa fa-bars"></i>'
            ]);

        if($this->security->isGranted('ROLE_SUPER_ADMIN'))
        {
            $child = $menu->addChild('tools1',[
                'label' => 'Tools',
            ])->setExtras(['icon' => '<i class="fa fa-wrench"></i>']);
            //RRHH
            $child = $menu->getChild("tools1");
            $child->addChild('tool_rrhh',[
                'label' => 'RRHH',
            ])->setExtras(['icon' => '<i class="fa fa-angle-double-right"></i>']);
            $tools = $child->getChild('tool_rrhh');
            $tools->addChild('Groups', [
                'route' => 'admin_app_sonatausergroup_list'
            ]);
            $tools->addChild('catalogos_puesto',[
                'label'=> ucfirst(mb_strtolower('Puestos')),
                'route'=>'admin_app_puesto_list'
            ]);
            $tools->addChild('catalogos_tiposangre',[
                'label'=> ucfirst(mb_strtolower('Tipo de Sangre')),
                'route'=>'admin_app_tiposangre_list'
            ]);
            $tools->addChild('catalogos_estadocivil',[
                'label'=> ucfirst(mb_strtolower('Estado Civil')),
                'route'=>'admin_app_estadocivil_list'
            ]);
            $tools->addChild('catalogos_funcion',[
                'label'=> ucfirst(mb_strtolower('Función')),
                'route'=>'admin_app_userfuncion_list'
            ]);
            //clientes
            $child = $menu->getChild("tools1");
            $child->addChild('tool_clientes',[
                'label' => 'Clientes',
            ])->setExtras(['icon' => '<i class="fa fa-angle-double-right"></i>']);
            $tools = $child->getChild('tool_clientes');
            $tools->addChild('usoCfdi',[
                'label'=> 'Usos del CFDI',
                'route'=>'admin_app_usocfdi_list'
            ]);
            $tools->addChild('tipoDomicilio',[
                'label'=> 'Tipos de Domicilio',
                'route'=>'admin_app_tipodomicilio_list'
            ]);
            //compras
            $child = $menu->getChild("tools1");
            $child->addChild('tool_compras',[
                'label' => 'Compras',
            ])->setExtras(['icon' => '<i class="fa fa-angle-double-right"></i>']);
            $tools = $child->getChild('tool_compras');
            $tools->addChild('formaspago',[
                'label'=> 'Formas de Pago',
                'route'=>'admin_app_formaspago_list'
            ]);
            $tools->addChild('bancos',[
                'label'=> 'Bancos',
                'route'=>'admin_app_bancos_list'
            ]);
            $tools->addChild('estatusPago',[
                'label'=> 'Estatus de Pagos',
                'route'=>'admin_app_estatuspago_list'
            ]);
            $tools->addChild('almacenajes',[
                'label'=> 'Almacenajes',
                'route'=>'admin_app_almacenajes_list'
            ]);
        }
        
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
            $child = $menu->addChild('Ventas')->setExtras(['icon' => '<i class="fa fa-truck"></i>']);

            $child = $menu->addChild('sonata_user', [
                'label' => 'RRHH',
                'route' => 'admin_app_sonatauseruser_list'
            ])->setExtras([
                'icon' => '<i class="fa fa-users"></i>'
            ]);

            $child = $menu->addChild('Reportes')->setExtras(['icon' => '<i class="fa fa-bar-chart"></i>']);

    }
}