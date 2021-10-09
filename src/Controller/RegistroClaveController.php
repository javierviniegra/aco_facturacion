<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistroClaveController extends AbstractController
{
    /**
     * @Route("/registro/clave", name="registro_clave")
     */
    public function index(): Response
    {
        return $this->render('registro_clave/index.html.twig', [
            'controller_name' => 'RegistroClaveController',
        ]);
    }
}
