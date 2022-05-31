<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComprasRecepcionController extends AbstractController
{
    /**
     * @Route("/compras/recepcion", name="app_compras_recepcion")
     */
    public function index(): Response
    {
        return $this->render('compras_recepcion/index.html.twig', [
            'controller_name' => 'ComprasRecepcionController',
        ]);
    }
}
