<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Routing\Annotation\Route;

//hash
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//login
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

//models
use App\Entity\User;

//forms
use App\Form\Type\RegisterType;

//doctrine
use Doctrine\Persistence\ManagerRegistry;

class UserController extends AbstractController
{
    //#[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    //passem request, l'encriptador, el manager doctrine
    public function register( Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        //nou user model
        $user = new User();

        //crear form RegisterType
        $form = $this ->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        //si form enviat i validat
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            
            //rol i data
            $user->setRole('ROLE_USER');
            $user->setCreatedAt(new \Datetime('now'));

            //pass
            $pass = $user->getPassword();
            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $passwordHasher->hashPassword($user,$pass);
            $user->setPassword($hashedPassword);
            
            $user = $form->getData();

            //test
            //var_dump($user);

            // ... perform some action, such as saving the task to the database

            $entityManager = $doctrine->getManager();
            //$user_repo = $doctrine->getRepository(User::class);

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            //return new Response('Saved new user with id '.$user->getId());
            return $this->renderForm('home/index.html.twig', [
                'ok' => 'ALTA USUARI OK :)'
            ]);
        }

        return $this->renderForm('user/registre.html.twig', [
            'form' => $form
        ]);

    }

    //login, passem utilitats login
    public function login(AuthenticationUtils $authenticationUtils): Response
      {
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
             'last_username' => $lastUsername,
             'error'         => $error,
          ]);
      }

}
