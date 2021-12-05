<?php

namespace App\Services;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class AuthenticationHandler implements  AuthenticationSuccessHandlerInterface {
    protected $container;

    public function __construct( $container ) {
        $this->container = $container;
    }

    public function onAuthenticationSuccess( Request $request, TokenInterface $token ) {
        $user = $token->getUser();
        if(in_array('ROLE_MANAGER',$user->getRoles())){
            $url = $this->container->get( 'router' )->generate( 'sonata_admin_dashboard' );
        }else{
            $url = $this->container->get( 'router' )->generate( 'home_dentistas' );
        }
        return new RedirectResponse( $url );

    }
}