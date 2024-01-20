<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;




class UserController extends AbstractController
{
    /**
     * @Route("/user/new", name="app_user")
     */
    public function index(UserPasswordHasherInterface $userPasswordHasher, Request $request, ManagerRegistry $doctrine): Response
    {
        $user = new User($userPasswordHasher);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          
            $em = $doctrine->getManager();
            // Assign roles (e.g., ROLE_USER)
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();
            dump($request);
            return $this->redirectToRoute("login");
        }
        return $this->render('/user/form.html.twig',[
            "form"=>$form->createView()
        ]);
    
        }
    
    
    
}
