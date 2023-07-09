<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Form\AddProfileType;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfileController extends AbstractController
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    #[Route('/profile', name: 'app_profile')]
    public function index(ManagerRegistry $entityManager): Response
    {
        $mixRepository = $entityManager->getRepository(User::class);
        $user = $mixRepository->findAll();

        return $this->render('profile/index.html.twig', [
            'controlle_name' => 'Profiles utilisateur',
            'users' => $user
        ]);
    }

    #[Route('/Authentification', name: 'app_addProfile')]
    public function addProfile(UserPasswordHasherInterface $passwordHasher, Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        /*$profile = new Profile();
        $form = $this->createForm(AddProfileType::class, $profile);
        $form->handleRequest($request);*/

        if ($form->isSubmitted() && $form->isValid()) {
            /*$user->setRoles(['ROLE_USER']);


            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));*/


            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('Password')->getData()
                )
            );
            /** @var UploadedFile $file */

            $file = $form->get('Picture')->getData();


            if ($file) {
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($fileName);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('profile_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                //$profile->setPicture($newFilename);
                $user->setPicture($newFilename);
            }
            /*$entityManager = $doctrine->getManager();
            $entityManager->persist($user);*/
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            /*$entityManager = $doctrine->getManager();
            $entityManager->persist($profile);
            $entityManager->flush();*/
            $this->addFlash('success', "L\'annonce a pas bien été ajouté à la liste ! ");
            return $this->redirectToRoute('app_home');
        }
        return $this->render('profile/addNewProfiler.html.twig', [
            'form' => $form->createView(),
            //'formA' => $formA->createView(),
            //'profiles' => $profile,
            'users' => $user,
        ]);
    }
}
