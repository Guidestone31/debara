<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\Users;
use App\Form\AddProfileType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegistrationController extends AbstractController
{
    #[Route('/AuthentificationWainting', name: 'app_auth')]
    public function index(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        // ... e.g. get the user data from a registration form
        $profil = new Profile();
        $form = $this->createForm(AddProfileType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('Image')->getData();
            //dd($form['Product_Image']->getData());
            //dd($file);

            if ($file) {

                $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($file_name);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                try {

                    $file->move(
                        $this->getParameter('profile_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                //$annoucement = new Annoucement();
                $profil->setPicture($newFilename);
            }
            // hash the password (based on the security.yaml config for the $user class)

            $entityManager = $doctrine->getManager();

            $entityManager->persist($profil);
            $entityManager->flush();
            $this->addFlash('success', "Le profil a pas bien été ajouté à la liste ! ");
            return $this->redirectToRoute('app_annoucement');            // ...
        }
        return $this->render('profile/new.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Formulaire',
        ]);
    }
}
