<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $request): Response
    {

        $session = $request->getSession();

        if ($session->has('nbreVisite')) {
            $nombreVisite = $session->has('nbreVisite') + 1;
        } else {
            $nombreVisite = 1;
        }
        $session->set('nbreVisite', $nombreVisite);

        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
