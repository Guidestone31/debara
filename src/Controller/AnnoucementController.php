<?php

namespace App\Controller;

use App\Entity\Annoucement;
use App\Form\AddAnnoucementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter;
use Symfony\Component\Routing\Annotation\Route;

class AnnoucementController extends AbstractController
{
    public function __construct(public AddAnnoucementType $service)
    {
    }
    #[Route('/annoucement', name: 'app_annoucement')]

    public function findAllAnnoucement(ManagerRegistry $entityManager): Response
    {
        $mixRepository = $entityManager->getRepository(Annoucement::class);
        $annoucement = $mixRepository->findAll();
        //dd($annoucement);
        //dd($mixRepository);
        return $this->render('annoucement/index.html.twig', ['controlle_name' => 'Nos annonces :', 'annoucements' => $annoucement]);
        /*$genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes = $this->mixRepository->findAll();
        return $this->render('annoucement/index.html.twig', [
            'controller_name' => 'AnnoucementController', 'annoucement_list' => $result
        ]);*/
        /*    public function index(ManagerRegistry $doctrine): Response
            {
                // $repository = $entityManager->getRepository(Annoucement::class);
                // $annoucement = $repository->findAll();
                $query = $this->getRepository('CoreBundle:Categories')->createQueryBuilder('c')->getQuery();
                $result = $query->getResult(Query::HYDRATE_ARRAY);
                return $this->render('annoucement/index.html.twig', [
                    'controller_name' => 'AnnoucementController', 'annoucement_list' => $result
                ]);
            }*/
    }

    #[Route('/formAddAnnoucement', name: 'app_formAddAnnoucement')]
    public function formAddAnnoucement(Request $request, ManagerRegistry $doctrine): Response
    {

        $form = $this->createForm(AddAnnoucementType::class, new Annoucement());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->saveData($form, $doctrine);
            return $this->redirectToRoute('app_annoucement');
        }

        return $this->render('annoucement/addAnnoucement.html.twig', [
            'controller_name' => 'Formulaire d\'ajout d\'annonce',
            'form' => $form,
        ]);
        //$builder->add('email', 'email');
        /*$builder->add('plainPassword', 'repeated', array(
            'Product_Name'  => 'name',
            'Product_Category' => 'category',
            'Product_Price' => 'price',
            'Product_Description' => 'description',
        ));*/

        //Ajouter l'operation d'insertion de l'utilisateur avec "persist" si l'id existe il va
        //automaitiquement mettre à jour si non il ajoute l'utilisateur en bd

        //$entityManager->persist($annoucement);

        //Execute la transaction
        /*$entityManager->flush();
        $this->addFlash('success', "L'annonce a bien été ajouté");

        return $this->render('annoucement/addAnnoucement.html.twig', [
            // 'utilisateur' => $utilisateur,
        ]);*/
    }
}
