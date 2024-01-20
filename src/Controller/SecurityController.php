<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class SecurityController extends AbstractController {
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils) {
        //si erreur de connexion il y a, celle-ci sera stocké dans la variable $error
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('\security\index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    /**
     * @Route("/app_logout", name="app_logout")
     */
    public function logout() {
       
    }
}