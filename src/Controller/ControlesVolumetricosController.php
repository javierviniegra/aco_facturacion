<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/controles", name="app_controles_volumetricos")
 */
class ControlesVolumetricosController extends AbstractController
{
    /**
     * @Route("/", name="_home")
     */
    public function index(): Response
    {
        return $this->render('controles_volumetricos/index.html.twig', [
            'controller_name' => 'ControlesVolumetricosController',
        ]);
    }
}
