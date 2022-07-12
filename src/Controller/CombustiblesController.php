<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Controller\CRUDController;

class CombustiblesController extends AbstractController
{
    /**
     * @Route("/combustibles", name="app_combustibles")
     */
    public function index(): Response
    {
        return $this->render('combustibles/index.html.twig', [
            'controller_name' => 'CombustiblesController',
        ]);
    }
}
