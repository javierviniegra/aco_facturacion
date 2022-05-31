<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//https://symfony.com/bundles/SonataAdminBundle/current/cookbook/recipe_custom_action.html
final class ComprasController extends CRUDController
{

    /**
     * @param $id
     */
    public function recepcionAction($id): Response
    {
        $objeto = $this->admin->getSubject();

        if (!$objeto) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        // Be careful, you may need to overload the __clone method of your object
        // to set its id to null !
        /*$recepcionObjeto = clone $objeto;

        $recepcionObjeto->setName($objeto->getName().' (Recepcion)');

        $this->admin->create($recepcionObjeto);


        $this->addFlash('sonata_flash_success', 'Cloned successfully');*/

        //return new RedirectResponse($this->admin->generateUrl('list'));

        return $this->render('compras/recepcion.html.twig', [
            'objeto' => $objeto,
            'productos' => $objeto->getProductos()
        ]);
    }


    /**
     * @param $id
     * @Route("/recepcion/{id}/alta", name="admin_app_compraproductos_recepcion_alta")
     */
    public function recibirAltaAction($id): Response
    {
        $objeto = $this->admin->getSubject();

        if (!$objeto) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        // Be careful, you may need to overload the __clone method of your object
        // to set its id to null !
        /*$recepcionObjeto = clone $objeto;

        $recepcionObjeto->setName($objeto->getName().' (Recepcion)');

        $this->admin->create($recepcionObjeto);


        $this->addFlash('sonata_flash_success', 'Cloned successfully');*/

        //return new RedirectResponse($this->admin->generateUrl('list'));

        return $this->render('compras/recepcion_alta.html.twig', [
            'producto' => $objeto,
        ]);
    }
}
