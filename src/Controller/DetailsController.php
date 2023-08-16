<?php

namespace App\Controller;

use App\Entity\Annoucement;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/detailsAnnoucements', name: 'detailsAnnoucements_')]

class DetailsController extends AbstractController
{
    #[Route('/', name: 'detail')]
    public function index(): Response
    {
        return $this->render('details/index.html.twig', [
            'controller_name' => 'DetailsController',
        ]);
    }

    #[Route('/{slug}', name: 'app_details', methods: ['GET'])]
    public function details(ManagerRegistry $doctrine, $slug): Response
    {
        $repository = $doctrine->getRepository(Annoucement::class);
        $annoucements = $repository->findOneBy(['slug' => $slug]);
        //dd($annoucements);
        return $this->render(
            'details/details.html.twig',
            ['annoucements' => $annoucements]
        );
    }
    /*
    public function details(ManagerRegistry $doctrine, $slug): Response
    {
        $repository = $doctrine->getRepository(Annoucement::class);
        $annoucements = $repository->find($slug);

        return $this->render('annoucement/details.html.twig', compact('annoucements'));
    }*/
}
