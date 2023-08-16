<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditUserType;
use App\Service\MailerService;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//#[Route('user')]

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
            'controlle_name' => 'Liste des utilisateurs',
            'users' => $user
        ]);
    }

    #[Route('/modife/user/{id}', name: 'editProfile', methods: ['GET', 'POST'])]

    public function editProfile(ManagerRegistry $doctrine, $id, Request $request, EntityManagerInterface $manager): Response
    {
        //$User->setRoles(['ROLE_USER']);
        //$this->denyAccessUnlessGranted("ROLE_USER");
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);
        //$username = $form->get('username')->getData();

        /*$plainPassword = $form->get('plainPassword')->getData();
        $Password = $password->isPasswordValid($User, $plainPassword);*/

        //$user = $this->getUser();

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_home');
        }

        if ($form->isSubmitted() && $form->isValid()) {

            // $currentPassword = $user->getPlainPassword();
            //if ($password->isPasswordValid($user, $form->get('plainPassword')->getData())) {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', "L\'annonce a pas bien été modifié à la liste ! ");
            return $this->redirectToRoute('app_home');
            // } else {
            //$this->addFlash('error', "L\'annonce n'est pas bien complété! ");
            //return $this->redirectToRoute('editProfile');
            // }
        }
        return $this->render('profile/editUserByUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/Authentification', name: 'app_addProfile')]
    public function addProfile(UserPasswordHasherInterface $passwordHasher, Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger, MailerService $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        /*$profile = new Profile();
        $form = $this->createForm(AddProfileType::class, $profile);
        $form->handleRequest($request);*/

        if ($this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        if ($this->getUser() == $user) {
            return $this->redirectToRoute('app_home');
        }

        $new = false;
        //$this->getDoctrine() : Version Sf <= 5
        if (!$user) {
            $new = true;
            $user = new User();
        }

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

            $Nouveau = $user->getEmail();
            $contenu = "Bienvenue sur le site Débara vous pourrez vous connectez et vous séparer du matériel laissé à l'abandon !";
            /*$entityManager = $doctrine->getManager();
            $entityManager->persist($profile);
            $entityManager->flush();*/
            $mailer->sendEmail(to: $Nouveau, content: $contenu, subject: "Welcome chez Débara!");
            $this->addFlash('success', "Le profil a pas bien été ajouté");
            return $this->redirectToRoute('app_home');
        }
        return $this->render('profile/addNewProfiler.html.twig', [
            'form' => $form->createView(),
            'page_name' => 'Hello',
            //'formA' => $formA->createView(),
            //'profiles' => $profile,
            'users' => $user,
        ]);
    }
    #[Route('/user/editUserPassword/{id}', name: 'edit_userPassword')]
    public function editPassword(Request $request, $id, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $repository = $entityManager->getRepository(User::class);
        $user = $repository->find($id);

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(UserPasswordType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            /** @var User $user */
            $plainPassword = $form->get('plainPassword')->getData();

            if (null !== $plainPassword) {
                $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));
            }
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été mis à jour');
            return $this->redirectToRoute('app_home');
        }
        return $this->render('profile/edit_userPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/formDelProfile/{id}', name: 'app_DelProfile')]
    public function deleteAnnoucement($id, ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);
        /*
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_home');
        }*/

        //$annoucement = new Annoucement();

        if ($user) {
            // Si la personne existe => le supprimer et retourner un flashMessage de succés
            $manager = $doctrine->getManager();
            // Ajoute la fonction de suppression dans la transaction
            $manager->remove($user);
            // Exécuter la transacition
            $manager->flush();

            $this->addFlash('success', "Le profile a été supprimée avec succès");
        } else {
            //Sinon  retourner un flashMessage d'erreur
            $this->addFlash('error', "Profile innexistante");
        }
        return $this->redirectToRoute('app_profile');
        /*
        // get EntityManager
        $entityManager = $doctrine->getManager();

        // Get a reference to the entity ( will not generate a query )
        $annoucement = $entityManager->getRepository(Annoucement::class)->findOneBy(['id' => $id]);

        // OR you can get the entity itself ( will generate a query )
        // $user = $em->getRepository('ProjectBundle:User')->find($id);

        // Remove it and flush
        $entityManager->remove($annoucement);
        $entityManager->flush();*/
    }
    // ...
}
