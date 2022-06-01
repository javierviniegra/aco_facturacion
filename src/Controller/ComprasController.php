<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CompraProductosRepository; 
use App\Entity\CompraProductos; 
use App\Form\RecepcionProductosType;

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
     * @param $id_prod
     * @param $id
     */
    public function recepcionAltaAction(Request $request, $id_prod, $id): Response
    {
        $objeto = $this->admin->getSubject();
        $em = $this->getDoctrine()->getManager();


        $producto =  $em->getRepository(CompraProductos::class)
                    ->findOneById($id_prod);
        $form = $this->createForm(RecepcionProductosType::class, $producto);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $producto = $form->getData();
            $producto->setRecibido(True);//pongo como recibido el producto

            $em->flush();

            return $this->redirectToRoute('admin_app_compras_recepcion', array('id' => $objeto->getId()));
        }

        return $this->render('compras/recepcion_alta.html.twig', [
            'objeto' => $objeto,
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param $id_prod
     * @param $id
     */
    public function recepcionMostrarAction(Request $request, $id_prod, $id): Response
    {
        $objeto = $this->admin->getSubject();
        $em = $this->getDoctrine()->getManager();

        $producto =  $em->getRepository(CompraProductos::class)
                    ->findOneById($id_prod);

        return $this->render('compras/recepcion_mostrar.html.twig', [
            'objeto' => $objeto,
            'producto' => $producto
        ]);
    }
}
