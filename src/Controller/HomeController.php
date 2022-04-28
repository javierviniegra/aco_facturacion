<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ElegirType;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ElegirType::class);

       $form->handleRequest($request);

           if ($form->isSubmitted() && $form->isValid()) {
               $registroFormData = $form->getData();

                $message = (new \Swift_Message('Email de Scanner Mureni - Dentistas!'))
                   ->setFrom($registroFormData['email'])
                   ->setTo('ayuda@mureni.com')
                   ->setBody(
                       $registroFormData['nombre'].' con émail: '.$registroFormData['email'].', requiere un escanneo el día: '.$registroFormData['fecha'].' con hora:'.$registroFormData['hora'],
                       'text/plain'
                   )
               ;

               $mailer->send($message);

               $this->addFlash('success', '<p class="font-bold">Tu mensaje fue enviado con exito.</p><p>Nos pondremos en contacto contigo a la brevedad.</p>');

               return $this->redirectToRoute('home_dentistas');
           }

        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/index.html.twig', [
                'user' => $this->getUser(),
                'form' => $form->createView(),
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