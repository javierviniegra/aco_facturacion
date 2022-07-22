<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VentasSalidasController extends AbstractController
{
    /**
     * @Route("/ventas/salidas", name="app_ventas_salidas")
     */
    public function index(): Response
    {
        return $this->render('ventas_salidas/index.html.twig', [
            'controller_name' => 'VentasSalidasController',
        ]);
    }
}
