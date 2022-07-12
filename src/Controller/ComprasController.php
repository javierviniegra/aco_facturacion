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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

//https://symfony.com/bundles/SonataAdminBundle/current/cookbook/recipe_custom_action.html
final class ComprasController extends CRUDController
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

        $registro = $this->getDoctrine()->getRepository('App:Compras')->find($id);

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

    public function pdfAction(Request $request)
    {
        $id = $request->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->admin->checkAccess('show', $object);

        $this->admin->setSubject($object);

        $response = $this->render('admin/pdf.html.twig', [
                'action' => 'print',
                'object' => $object,
                'elements' => $this->admin->getShow(),
            ]);

        $cacheDir = $this->container->getParameter('kernel.cache_dir');
        $name = tempnam($cacheDir.DIRECTORY_SEPARATOR, '_print');
        file_put_contents($name, $response->getContent());
        $hash = base64_encode($name);

        $options['viewport-size'] = '769x900';

        $url = $this->container->get('router')->generate('app_print', ['hash' => $hash], Router::ABSOLUTE_URL);

        $pdf = $this->container->get('knp_snappy.pdf')->getOutput($url, $options);

        return new Response(
            $pdf,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'filename="show.pdf"',
            ]
        );
    }

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
