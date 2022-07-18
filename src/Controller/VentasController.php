<?php

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CompraProductosRepository; 
use App\Entity\ProductosVenta; 
use App\Form\RecepcionProductosType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class VentasController extends CRUDController
{

    //override para hacer delete de las compras
    public function deleteAction($id)
    {
        if (false === $this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        //usuario loggeado
        $user = $this->getUser();

        $registro = $this->getDoctrine()->getRepository('App:Ventas')->find($id);

        $registro->setIsDeleted(true);
        $registro->setFechaBorrado(new \DateTime());
        $registro->setQuienBorro($user);
        $em->flush();

        $this->addFlash('sonata_flash_success', 'Elemento marcado como borrado');

        return new RedirectResponse(
            $this->admin->generateUrl('list',
                $this->admin->getFilterParameters())
        );
    }
    //override para hacer delete de las compras
    public function batchActionDelete(\Sonata\AdminBundle\Datagrid\ProxyQueryInterface $query)
    {
        if (false === $this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        //usuario loggeado
        $user = $this->getUser();

        $res = $query->execute();

        if (count($res)) {
            foreach ($res as $registro) {
                $registro->setIsDeleted(true);
                $registro->setFechaBorrado(new \DateTime());
                $registro->setQuienBorro($user);
                $em->flush();
            }

            $this->addFlash('sonata_flash_success', 'Elemento marcado como borrado');
        }

        return new RedirectResponse(
            $this->admin->generateUrl('list',
                $this->admin->getFilterParameters())
        );
    }

}
