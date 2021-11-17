<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\UserBundle;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\RegistrationController as Base;

use App\Entity\RegisroClave;

class RegistrationController extends Base
{

    private $eventDispatcher;
    private $formFactory;
    private $userManager;
    private $tokenStorage;

    public function __construct(EventDispatcherInterface $eventDispatcher, FactoryInterface $formFactory, UserManagerInterface $userManager, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($eventDispatcher, $formFactory, $userManager, $tokenStorage);
        $this->eventDispatcher = $eventDispatcher;
        $this->formFactory = $formFactory;
        $this->userManager = $userManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/register/{clave}", name="register")
     */
    public function registersAction(Request $request, $clave = "r3")
    {
        $em = $this->getDoctrine()->getManager();
        $elRegistroClave = $em->getRepository('App\Entity\RegisroClave')->findOneByClave($clave);
        If ($elRegistroClave== null){
            return $this->render('registro_clave/error_registro.html.twig');
        }

        $user = $this->userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $this->eventDispatcher->dispatch($event, FOSUserEvents::REGISTRATION_INITIALIZE);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->formFactory->createForm();
        $form->setData($user);
        $form->getData()->setUsername($form->getData()->getEmail());

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $this->eventDispatcher->dispatch($event, FOSUserEvents::REGISTRATION_SUCCESS);

                $this->userManager->updateUser($user);

                //invalido la clave
                $elRegistroClave = $em->getRepository('App\Entity\RegisroClave')->invalidarClave($clave);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('home_dentistas');
                    $response = new RedirectResponse($url);
                }

                $this->eventDispatcher->dispatch(new FilterUserResponseEvent($user, $request, $response), FOSUserEvents::REGISTRATION_COMPLETED);

                return $response;
            }

            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch($event, FOSUserEvents::REGISTRATION_FAILURE);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }
        return $this->render('bundles/FOSUserBundle/Registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return string|null
     */
    private function getTargetUrlFromSession(SessionInterface $session)
    {
        $key = sprintf('_security.%s.target_path', $this->tokenStorage->getToken()->getProviderKey());

        if ($session->has($key)) {
            return $session->get($key);
        }

        return null;
    }

}
