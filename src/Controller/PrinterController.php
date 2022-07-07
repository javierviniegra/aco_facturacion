<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/core/print")
 */
class PrinterController extends AbstractController
{
    /**
     * @Route(path="/{hash}", name="app_print")
     *
     * @param string $hash
     *
     * @return Response
     */
    public function indexAction($hash)
    {
        $file = base64_decode($hash);
        if (!file_exists($file)) {
            throw new NotFoundHttpException();
        }

        $response = new Response(file_get_contents($file));
        unlink($file);

        return $response;
    }
}
