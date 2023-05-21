<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home/{name}/{firstname}', name: 'app_home')]
    public function index(Request $request, $name, $firstname): Response
    {
        dd($request);

        return $this->render('home/index.html.twig', [
            'controller_name' => ' Home Controller',
            'nom' => $name,
            'pseudo' => $firstname,
        ]);
    }

    #[Route('/pres', name: 'app_pres')]
    public function pres(): Response
    {
        $rand = rand(0, 10);

        echo $rand;

        if ($rand == 3) {

            return $this->redirectToRoute('app_home');
        }

        return $this->forward('App\Controller\ HomeController::index');
    }
}
