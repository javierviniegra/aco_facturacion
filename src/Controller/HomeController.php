<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_dentistas")
     */
    public function index(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/index.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            //return $this->redirect('http://mureni.com');
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/precios", name="dent_precios")
     */
    public function preciosAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/precios.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/scanners", name="dent_scanners")
     */
    public function scannersAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/scanners.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/casos", name="dent_casos")
     */
    public function casosAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/casos.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/preguntas", name="dent_preguntas")
     */
    public function preguntasAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/preguntas.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/empresa", name="dent_empresa")
     */
    public function empresaAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/empresa.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }
}