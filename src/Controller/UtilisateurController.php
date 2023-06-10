<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateur')]
class UtilisateurController extends AbstractController
{
    #[Route('/', name: 'utilisateur.acceuil')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Utilisateur::class);
        $utilisateur = $repository->findAll();
        return $this->render('utilisateur/detail.html.twig', ['utilisateurs' => $utilisateur]);
    }
    #[Route('/add', name: 'utilisateur.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        // $utilisateur = new Utilisateur();
        // $utilisateur->setFirstname('Fayssal');
        // $utilisateur->setLastname('Messiid');
        // $utilisateur->setMail('Fays83310@gmail.com');
        // $utilisateur->setPseudo('Guidestone');
        // $utilisateur->setMdp('Guidestone');


        //Ajouter l'operation d'insertion de l'utilisateur avec "persist" si l'id existe il va
        //automaitiquement mettre à jour si non il ajoute l'utilisateur en bd

        // $entityManager->persist($utilisateur);

        //Execute la transaction
        $entityManager->flush();

        return $this->render('utilisateur/index.html.twig', [
            // 'utilisateur' => $utilisateur,
        ]);
    }
}
