<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CoreController as BaseCoreController;

class CoreController extends BaseCoreController
{

    public function dashboardAction()
    {
    	$combustibles = $this->getDoctrine()->getRepository('App:Combustibles')->findAll();
        $tanques = $this->getDoctrine()->getRepository('App:Almacenajes')->findAll();

        return $this->render('home/dashboard.html.twig', [
            'combustibles' => $combustibles,
            'tanques' => $tanques
        ]);
    }
}