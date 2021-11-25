<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactoType;
use Symfony\Component\HttpFoundation\Request;

class ContactoController extends AbstractController
{
    /**
     * @Route("/contacto", name="dent_contacto")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactoType::class);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           $contactFormData = $form->getData();

            $message = (new \Swift_Message('Email de Contacto Mureni - Dentistas!'))
               ->setFrom($contactFormData['email'])
               ->setTo('ayuda@mureni.com')
               ->setBody(
                   $contactFormData['nombre'].' con émail: '.$contactFormData['email'].' y número Whatsapp: '. $contactFormData['whatsapp'].', envía el siguiente mensaje: '.$contactFormData['mensaje'],
                   'text/plain'
               )
           ;

           $mailer->send($message);

           $this->addFlash('success', '<p class="font-bold">Tu mensaje fue enviado con exito.</p><p>Nos pondremos en contacto contigo a la brevedad.</p>');

           return $this->redirectToRoute('dent_contacto');
       }

        return $this->render('contacto/index.html.twig', [
           'form' => $form->createView(),
       ]);
    }
}
