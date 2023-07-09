<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
