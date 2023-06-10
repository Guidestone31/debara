<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AddAnnoucementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPresController extends AbstractController
{
    public function __construct(public AddAnnoucementType $service)
    {
    }
    #[Route('/users', name: 'app_users')]

    public function findAllAnnoucement(ManagerRegistry $entityManager): Response
    {
        $mixRepository = $entityManager->getRepository(User::class);
        $user = $mixRepository->findAll();
        //dd($annoucement);
        //dd($mixRepository);
        return $this->render('user_pres/index.html.twig', ['controlle_name' => 'Liste des utilisateurs :', 'users' => $user]);
    }
}
