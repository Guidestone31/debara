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
    public function index(ManagerRegistry $entityManager): Response
    {
        //dd($request);
        /* $repository = $doctrine->getRepository(Annoucement::class);
         $annonce = $repository->findAll();
         return $this->render('home/index.html.twig', ['annonces' => $annonce, 'controller_name' => 'Debara', 'page_name' => 'Acceuil']);*/

        $mixRepository = $entityManager->getRepository(Annoucement::class);
        $annoucements = $mixRepository->findAll();
        //dd($annoucements);
        //dd($mixRepository);
        //return $this->render('annoucement/index.html.twig', ['controlle_name' => 'Nos annonces :', 'annoucements' => $annoucements]);
        return $this->render('home/index.html.twig', ['annoucements' => $annoucements, 'controller_name' => 'Debara', 'page_name' => 'Acceuil']);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        //dd($request);
        //$repository = $doctrine->getRepository(Annoucement::class);
        //$annonce = $repository->findAll();
        return $this->render('home/contact.html.twig', ['controller_name' => 'Contact', 'page_name' => 'Contact']);
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
