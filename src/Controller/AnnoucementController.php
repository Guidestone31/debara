<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoucementController extends AbstractController
{
    #[Route('/annoucement', name: 'app_annoucement')]
    public function index(): Response
    {
        return $this->render('annoucement/index.html.twig', [
            'controller_name' => 'AnnoucementController',
        ]);
    }
}
