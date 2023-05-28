<?php

namespace App\Controller;

use App\Entity\Annoucement;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        //dd($request);
        $repository = $doctrine->getRepository(Annoucement::class);
        $annonce = $repository->findAll();
        return $this->render('home/index.html.twig', ['annonces' => $annonce, 'controller_name' => 'Debara', 'page_name' => 'Acceuil']);
    }

    //#[Route('/pres', name: 'app_pres')]
    /* public function pres(): Response
    {
        $rand = rand(0, 10);

        echo $rand;

        if ($rand == 3) {

            return $this->redirectToRoute('app_home');
        }

        return $this->forward('App\Controller\ HomeController::index');
    }*/
}
