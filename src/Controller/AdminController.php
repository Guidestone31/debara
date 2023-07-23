<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Form\EditUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'app_admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/profile', name: 'app_profile')]
    public function users(ManagerRegistry $entityManager): Response
    {
        $mixRepository = $entityManager->getRepository(User::class);
        $user = $mixRepository->findAll();

        return $this->render('profile/index.html.twig', [
            'controlle_name' => 'Profiles utilisateur',
            'users' => $user
        ]);
    }
    #[Route('/user/modifier/{id}', name: 'user_modifier')]
    public function editUsers(Request $request, ManagerRegistry $doctrine): Response
    {

        $user = new User();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', "L\'utilisateur a pas bien été modifié ! ");
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('admin/edituser.html.twig', [
            'userform' => $form->createView(),
            'controlle_name' => 'Modifier l\'utilisateur',
        ]);
    }
}
