<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Entity\Users;
use App\Form\AddProfileType;
use App\Form\AddUserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserRegistrationController extends AbstractController
{
    #[Route('/Authentificationpending', name: 'app_authPass')]
    public function nweUser(UserPasswordHasherInterface $passwordHasher, Request $request, ManagerRegistry $doctrine): Response
    {
        // ... e.g. get the user data from a registration form
        $user = new User();
        $form = $this->createForm(AddUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', "Bienvenue !");
            return $this->redirectToRoute('app_annoucement');
        }
        //$user->setPassword($passwordHasher);
        return $this->render('securProfile/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Formulaire',
        ]);
        /*return $this->render('securProfile/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Formulaire',
        ]);*/
    }
}
