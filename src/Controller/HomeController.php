<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
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
}