<?php

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductosVentaRepository; 
use App\Entity\CompraProductos; 
use App\Entity\Combustibles; 
use App\Entity\Almacenajes; 
use App\Entity\ProductosVenta; 
use App\Form\SalidaProductosType;
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

    /**
     * @param $id
     */
    public function salidasAction($id): Response
    {
        $objeto = $this->admin->getSubject();

        if (!$objeto) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        //return new RedirectResponse($this->admin->generateUrl('list'));

        return $this->render('ventas/salidas.html.twig', [
            'objeto' => $objeto,
            'productos' => $objeto->getProductosVenta()
        ]);
    }

    /**
     * @param $id_prod
     * @param $id
     */
    public function salidaAltaAction(Request $request, $id_prod, $id): Response
    {
        $objeto = $this->admin->getSubject();
        $em = $this->getDoctrine()->getManager();


        $producto =  $em->getRepository(ProductosVenta::class)
                    ->findOneById($id_prod);
        $combustible =  $em->getRepository(Combustibles::class)
                    ->findWhereProductoId($producto->getProducto()->getId());
        $tanques = $em->getRepository(Almacenajes::class)
                    ->findWhereCombustibleId($combustible[0]->getId());
        $form = $this->createForm(SalidaProductosType::class, $producto);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $producto = $form->getData();
            $producto->setEntregado(True);//pongo como entregado el producto

            $tanque = $producto->getAlmacenaje();//obtengo el tanque
            $litrosTotales = $tanque->getTotal();//total de litros
            if(is_null($litrosTotales)) $litrosTotales = 0;
            $litrosIngresar = $producto->getLitros();//obtengo los nuevos litros a sumar
            //hago la operacion de suma
            $nuevoTotal = $litrosTotales - $litrosIngresar;//hago la resta

            //Persisto el nuevo valor
            $tanque->setTotal($nuevoTotal);

            $em->flush();

            return $this->redirectToRoute('admin_app_ventas_salidas', array('id' => $objeto->getId()));
        }

        return $this->render('ventas/salida_alta.html.twig', [
            'objeto' => $objeto,
            'producto' => $producto,
            'form' => $form->createView(),
            'tanques' => $tanques,
        ]);
    }

    /**
     * @param $id_prod
     * @param $id
     */
    public function salidaMostrarAction(Request $request, $id_prod, $id): Response
    {
        $objeto = $this->admin->getSubject();
        $em = $this->getDoctrine()->getManager();

        $producto =  $em->getRepository(ProductosVenta::class)
                    ->findOneById($id_prod);

        return $this->render('ventas/salida_mostrar.html.twig', [
            'objeto' => $objeto,
            'producto' => $producto
        ]);
    }

}
