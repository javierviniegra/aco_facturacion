<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Controller\CRUDController;

class AlmacenajesController extends CRUDController
{

    public function deleteAction($id) // NEXT_MAJOR: Remove the unused $id parameter
    {
        if (false === $this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $tanque = $this->getDoctrine()->getRepository('App:Almacenajes')->find($id);

        $tanque->setIsActive(false);
        $tanque->setUpdatedAt(new \DateTime());
        $em->flush();

        $this->addFlash('sonata_flash_success', 'Elemento marcado como borrado');

        return new RedirectResponse(
            $this->admin->generateUrl('list',
                $this->admin->getFilterParameters())
        );
    }

    //override para hacer delete de las compras
    public function batchActionDelete(ProxyQueryInterface $query)
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
                $registro->setIsActive(false);
                $registro->setUpdatedAt(new \DateTime());
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
