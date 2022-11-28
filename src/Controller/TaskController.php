<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Routing\Annotation\Route;

//test traduccions
use Symfony\Contracts\Translation\TranslatorInterface;

//per obtenir user actual
use Symfony\Component\Security\Core\User\UserInterface;

//models
use App\Entity\Task;
use App\Entity\User;

//forms
use App\Form\Type\TascaType;

//doctrine
//use Doctrine\ORM\EntityManagerInterface;
//use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;


class TaskController extends AbstractController
{
    //test
    public function test( ManagerRegistry $doctrine, TranslatorInterface $translator ): Response
    {   
        /*
        Farem 2 comprovacions;
        ● Primera prova comprovar el llistat de tasques i l'usuari relacionat a
        cada tasca
        ● Segona: Treure el llistat de tasques que fa cada usuari
        */

        //$em = $this->getDoctrine()->getManager();
        //$entityManager = $doctrine->getManager();
        
        //$task_repo = $this->getDoctrine()->getRepository(Task::class);
        $task_repo = $doctrine->getRepository(Task::class);

        $tasks = $task_repo->findAll();

        foreach( $tasks as $task ) {
            echo $task->getUser()->getEmail(). ' : '. $task->getTitle() . "<br>";
        }

        $user_repo = $doctrine->getRepository(User::class);
        $users = $user_repo->findAll();

        foreach($users as $user) {
            echo "<h2> {$user->getName()} {$user->getSurName()} </h2> ";
            
            foreach($user->getTasks() as $task) {
                echo $task->getTitle() . "<br>";
            }
        }

        //test translation
        //traduccions a translations/messages.ca.yaml
        $translated = $translator->trans('Symfony is great');
        echo $translated;

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    public function tasques( ManagerRegistry $doctrine  ): Response
    {   
        //$entityManager = $doctrine->getManager();
        $task_repo = $doctrine->getRepository(Task::class);
        $tasks = $task_repo->findAll();

        return $this->render('task/tasques.html.twig', [
            'tasques' => $tasks
        ]);
    }

    //les meves tasques, passem usuari
    public function meves( ManagerRegistry $doctrine, UserInterface $user  ): Response
    {   
        //$entityManager = $doctrine->getManager();
        $task_repo = $doctrine->getRepository(Task::class);
        $tasks = $task_repo->findBy(
            ['user' => $user],
            ['createdAt' => 'ASC']);

        return $this->render('task/meves.html.twig', [
            'tasques' => $tasks
        ]);
    }


    //https://symfony.com/doc/current/doctrine.html#automatically-fetching-objects-paramconverter
    //pas automàtic de id a objecte
    //composer require sensio/framework-extra-bundle

    public function detall(Task $task): Response
    {   
        if (!$task) {
            return $this -> redirectToRoute('tasques');
        
        } else {
            return $this -> render('task/detall.html.twig', [
                'tasca' => $task
            ]);
        }
    }

    //passem request, manager doctrine i usuari
    public function crear( Request $request,  ManagerRegistry $doctrine, UserInterface $user ): Response
    {
        //nou user model
        $task = new Task();

        //crear form TascaType
        $form = $this ->createForm(TascaType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            
            //user i data
            $task->setUser($user);
            $task->setCreatedAt(new \Datetime('now'));
            
            $task = $form->getData();

            //test
            //var_dump($task);

            // ... perform some action, such as saving the task to the database

            $entityManager = $doctrine->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($task);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            //return new Response('Saved new task with id '.$task->getId());
            //return $this->redirectToRoute('tasques');
            return $this->redirect(
                $this->generateUrl('tasca_detall', ['id' => $task->getId()])
            );
        }

        return $this->renderForm('task/crear.html.twig', [
            'form' => $form,
            'edit' => false
        ]);
    }

    //passem request, manager doctrine, usuari i tasca amb paramconverter
    public function editar( Request $request,  ManagerRegistry $doctrine, UserInterface $user, Task $task ): Response
    {
        // si no hi ha user o l'id del user no és la id del user de la tasca que edita
        if (!$user || ( $user->getId() != $task->getUser()->getId() ) ) {
            return $this->redirectToRoute('tasques');
        
        } else {
            
            //crear form TascaType i assignem la tasca que ve per paràmetre
            $form = $this ->createForm(TascaType::class, $task);
            $form->handleRequest($request);

            //si form enviat i validat
            if ($form->isSubmitted() && $form->isValid()) {
                
                //guardar user i data no fa falta______________
                //$task->setUser($user);
                //$task->setCreatedAt(new \Datetime('now'));
                
                //obtenir dades form
                $task = $form->getData();

                //test
                //var_dump($task);

                //doctrine update
                $entityManager = $doctrine->getManager();
                $entityManager->persist($task);
                $entityManager->flush();

                //mostrem detall amb les dades actualitzades
                return $this->redirect(
                    $this->generateUrl('tasca_detall', ['id' => $task->getId()])
                );
            }
            //render form aprofitant template crear i boleana edit
            return $this->renderForm('task/crear.html.twig', [
                'form' => $form,
                'edit' => true
            ]);
        }
    }

    //passem request, manager doctrine, usuari i tasca amb paramconverter
    public function borrar( ManagerRegistry $doctrine, UserInterface $user, Task $task ): Response
    {
        // si no hi ha user o l'id del user no és la id del user de la tasca que borra
        if (!$user || ( $user->getId() != $task->getUser()->getId() ) ) {
            return $this->redirectToRoute('tasques');
        
        } else {
            
            //test
            //var_dump($task);

            //doctrine remove
            $entityManager = $doctrine->getManager();
            $entityManager->remove($task);
            $entityManager->flush();

            //redirigim
            return $this->redirectToRoute('tasques');
        }
    }
    
}
