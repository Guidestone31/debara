<?php

namespace App\Controller;

use App\Entity\Annoucement;
//use App\service\FileUploader;
use App\Entity\User;
use App\Entity\Picture;
use App\Form\AddAnnoucementType;
use App\Form\EditAnnoucementType;
use App\Model\SearchData;
use App\Form\SearchType;
use App\Repository\AnnoucementRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

//#[Route('/annoucement', name: 'annoucement_')]
class AnnoucementController extends AbstractController
{
    public function __construct(
        public AddAnnoucementType $service,
        private LoggerInterface $logger,
        //private Helpers $helper,
        private EventDispatcherInterface $dispatcher
    ) {
    }

    #[Route('/annoucement/{page?1}/{nbre?8}', name: 'app_annoucement')]

    public function findAllAnnoucement(ManagerRegistry $entityManager, AnnoucementRepository $annoucementRepository, Request $request, $page, $nbre): Response
    {
        /*
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $searchData->page = $request->query->getInt('page', 1);
            $annoucementst = $annoucementRepository->findBySearch($searchData);

            return $this->render('pages/post/index.html.twig', [
                'form' => $form->createView(),
                'annoucements' => $annoucementst
            ]);
        }*/

        $mixRepository = $entityManager->getRepository(Picture::class);
        $pictures = $mixRepository->findAll();
        $mixRepository = $entityManager->getRepository(Annoucement::class);
        $nbreAnnoucement = $mixRepository->count([]);
        $nbrPage = ceil($nbreAnnoucement / $nbre);

        $annoucements = $mixRepository->findBY([], [], $nbre, ($page - 1) * $nbre);
        //dd($annoucements);
        //dd($mixRepository);
        return $this->render(
            'annoucement/index.html.twig',
            [
                'controlle_name' => 'Nos annonces :', 'annoucements' => $annoucements, 'pictures' => $pictures,  'isPaginated' => true,
                'nbrePage' => $nbrPage,
                'page' => $page,
                'nbre' => $nbre
            ]
        );
        //return $this->render('annoucement/index.html.twig', compact('annoucements'));
    }

    #[Route('/annoucement/{id}', name: 'app_userAnnoucements')]

    public function findAnnoucementById($id, ManagerRegistry $doctrine, ManagerRegistry $entityManager): Response
    {

        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_home');
        }

        $mixRepository = $entityManager->getRepository(Annoucement::class);
        $annoucement = $mixRepository->findAll();

        //dd($annoucement);
        //dd($mixRepository);
        return $this->render(
            'user_registration/AnnoucesUsers.html.twig',
            [
                'controlle_name' => 'Nos annonces :',
                'annoucements' => $annoucement,
                'users' => $user,
                'id' => $id
            ]
        );
    }

    #[Route('/formAddAnnoucement/{id}', name: 'app_AddAnnoucement')]
    public function addAnnoucement(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, FileUploader $pictureService): Response
    {

        //$User->setRoles(['ROLE_USER']);
        $this->denyAccessUnlessGranted("ROLE_USER");
        /*if (!$this->denyAccessUnlessGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }*/
        //On crée un "nouveau produit"
        $annoucement = new Annoucement();

        // On crée le formulaire
        $announceForm = $this->createForm(AddAnnoucementType::class, $annoucement);

        // On traite la requête du formulaire
        $announceForm->handleRequest($request);

        $new = false;

        //$this->getDoctrine() : Version Sf <= 5
        if (!$annoucement) {
            $new = true;
            $annoucement = new Annoucement();
        }

        //On vérifie si le formulaire est soumis ET valide
        if ($announceForm->isSubmitted() && $announceForm->isValid()) {
            // On récupère les images
            $image = $announceForm->get('Image')->getData();

            foreach ($image as $images) {
                // On définit le dossier de destination
                $folder = 'annonces';

                // On appelle le service d'ajout
                $fichier = $pictureService->add($images, $folder, 300, 300);

                $img = new Picture();
                $img->setName($fichier);
                $annoucement->addPicture($img);
            }

            // On génère le slug
            $slug = $slugger->slug($annoucement->getNom());
            $annoucement->setSlug($slug);

            // On arrondit le prix
            // $prix = $product->getPrice() * 100;
            // $product->setPrice($prix);
            if ($new) {
                $message = " a été mis à jour avec succès";
            } else {
                $message = " a été ajouté avec succès";
                $annoucement->setCreatedBy($this->getUser());
            }
            // On stocke
            $em->persist($annoucement);
            $em->flush();

            // On redirige
            $this->addFlash('success', "L\'annonce a pas bien été ajouté à la liste ! $message");
            return $this->redirectToRoute('app_annoucement', array('id' => $annoucement->getId()));
        }


        // return $this->render('admin/products/add.html.twig',[
        //     'productForm' => $productForm->createView()
        // ]);

        return $this->render('annoucement/addFormAnnoucement.html.twig', [
            'form' => $announceForm->createView(),
            'annoucements' => $annoucement,
        ]);
    }

    #[Route('/formDelAnnoucement/{id}', name: 'app_DelAnnoucement')]
    public function deleteAnnoucement($id, ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Annoucement::class);
        $annoucement = $repository->find($id);
        /*
                    if (!$this->getUser()) {
                        return $this->redirectToRoute('app_login');
                    }
                    if ($this->getUser() !== $user) {
                        return $this->redirectToRoute('app_home');
                    }*/

        //$annoucement = new Annoucement();

        if ($annoucement) {
            // Si la personne existe => le supprimer et retourner un flashMessage de succés
            $manager = $doctrine->getManager();
            // Ajoute la fonction de suppression dans la transaction
            $manager->remove($annoucement);
            // Exécuter la transacition
            $manager->flush();

            $this->addFlash('success', "L\'annonce a été supprimée avec succès");
        } else {
            //Sinon  retourner un flashMessage d'erreur
            $this->addFlash('error', "Annonce innexistante");
        }
        return $this->redirectToRoute('app_annoucement');
        /*
                    // get EntityManager
                    $entityManager = $doctrine->getManager();

                    // Get a reference to the entity ( will not generate a query )
                    $annoucement = $entityManager->getRepository(Annoucement::class)->findOneBy(['id' => $id]);

                    // OR you can get the entity itself ( will generate a query )
                    // $user = $em->getRepository('ProjectBundle:User')->find($id);

                    // Remove it and flush
                    $entityManager->remove($annoucement);
                    $entityManager->flush();*/
    }
    #[Route('/modife/annoucement/{id}', name: 'editAnnoucement', methods: ['GET', 'POST'])]

    public function editAnnoucement($id, Request $request, ManagerRegistry $doctrine, EntityManagerInterface $manager, SluggerInterface $slugger, FileUploader $pictureService): Response
    {
        /*$repository = $manager->getRepository(User::class);
        $user = $repository->find($id);*/
        //$User->setRoles(['ROLE_USER']);
        //$this->denyAccessUnlessGranted("ROLE_USER");
        $repository = $doctrine->getRepository(Annoucement::class);
        //$annoucement = $repository->find($slug);
        $annoucements = $repository->find($id);

        //$repository = $doctrine->getRepository(User::class);
        //$user = $repository->find($id);

        $form = $this->createForm(EditAnnoucementType::class, $annoucements);
        $form->handleRequest($request);

        $new = false;

        //$this->getDoctrine() : Version Sf <= 5
        if (!$annoucements) {
            $new = true;
            $annoucements = new Annoucement();
        }
        //$username = $form->get('username')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images
            $image = $form->get('Image')->getData();


            foreach ($image as $images) {
                // On définit le dossier de destination
                $folder = 'annonces';

                // On appelle le service d'ajout
                $fichier = $pictureService->add($images, $folder, 300, 300);

                $img = new Picture();
                $img->setName($fichier);
                $annoucements->addPicture($img);
            }

            // On génère le slug
            $slug = $slugger->slug($annoucements->getNom());
            $annoucements->setSlug($slug);


            if ($new) {
                $message = " a été mis à jour avec succès";
            } else {
                $message = " a été ajouté avec succès";
                $annoucements->setCreatedBy($this->getUser());
            }
            //$annoucements = $form->getData();
            $manager->persist($annoucements);
            $manager->flush();

            $this->addFlash('success', "L\'annonce a pas bien été modifié à la liste ! $message ");
            return $this->redirectToRoute('app_home');
            // } else {
            //$this->addFlash('error', "L\'annonce n'est pas bien complété! ");
            //return $this->redirectToRoute('editProfile');
            // }
        }
        return $this->render('annoucement/editAnnoucementByUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
