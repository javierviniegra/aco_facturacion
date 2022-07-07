<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\Response;

final class ClientesController extends CRUDController
{

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

}
