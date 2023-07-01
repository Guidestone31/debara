<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\AddProfileType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(ManagerRegistry $entityManager): Response
    {
        $mixRepository = $entityManager->getRepository(Profile::class);
        $profile = $mixRepository->findAll();

        return $this->render('profile/index.html.twig', [
            'controlle_name' => 'Profiles utilisateur',
            'profiles' => $profile
        ]);
    }
    #[Route('/Authentification', name: 'app_addProfile')]
    public function addProfile(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $profile = new Profile();
        $form = $this->createForm(AddProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
                $profile->setPicture($newFilename);
            }
            $entityManager = $doctrine->getManager();
            $entityManager->persist($profile);
            $entityManager->flush();
            $this->addFlash('success', "L\'annonce a pas bien été ajouté à la liste ! ");
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('profile/addNewProfiler.html.twig', [
            'form' => $form->createView(),
            'profiles' => $profile,
        ]);
    }
}
