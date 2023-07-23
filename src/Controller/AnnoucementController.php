<?php

namespace App\Controller;

use App\Entity\Annoucement;
//use App\service\FileUploader;
use App\Entity\User;
use App\Entity\Picture;
use App\Form\AddAnnoucementType;
use App\service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AnnoucementController extends AbstractController
{
    public function __construct(
        public AddAnnoucementType $service,
        private LoggerInterface $logger,
        //private Helpers $helper,
        private EventDispatcherInterface $dispatcher
    ) {
    }
    #[Route('/annoucement', name: 'app_annoucement')]

    public function findAllAnnoucement(ManagerRegistry $entityManager): Response
    {
        $mixRepository = $entityManager->getRepository(Picture::class);
        $pictures = $mixRepository->findAll();
        $mixRepository = $entityManager->getRepository(Annoucement::class);
        $annoucements = $mixRepository->findAll();
        //dd($annoucements);
        //dd($mixRepository);
        return $this->render(
            'annoucement/index.html.twig',
            ['controlle_name' => 'Nos annonces :', 'annoucements' => $annoucements, 'pictures' => $pictures]
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

        //On crée un "nouveau produit"
        $annoucement = new Annoucement();

        // On crée le formulaire
        $announceForm = $this->createForm(AddAnnoucementType::class, $annoucement);

        // On traite la requête du formulaire
        $announceForm->handleRequest($request);

        //$this->denyAccessUnlessGranted('ROLE_USER');
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
    // ['productForm' => $productForm]
    /* public function addAnnoucement(Request $request, $id, ManagerRegistry $doctrine, SluggerInterface $slugger, FileUploader $picture): Response
        {

            // dummy code - add some example tags to the task
            // (otherwise, the template will render an empty list of tags)
            $repository = $doctrine->getRepository(User::class);
            $user = $repository->find($id);

            if (!$this->getUser()) {
                return $this->redirectToRoute('app_login');
            }
            if ($this->getUser() !== $user) {
                return $this->redirectToRoute('app_home');
            }

            $annoucement = new Annoucement();
            $form = $this->createForm(AddAnnoucementType::class, $annoucement);
            $form->handleRequest($request);


            $this->denyAccessUnlessGranted('ROLE_USER');
            $new = false;

            //$this->getDoctrine() : Version Sf <= 5
            if (!$annoucement) {
                $new = true;
                $annoucement = new Annoucement();
            }

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var UploadedFile $file */
    // $files = $form->get('Image')->getData();
    //dd($form['Product_Image']->getData());
    //dd($file);
    /* foreach ($files as $file) {
                    $folder = 'annonces';
                    $fichier = $picture->add($file, $folder, 300, 300);
                    /* if ($file) {

                        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $safeFilename = $slugger->slug($file_name);
                        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                        try {

                            $file->move(
                                $this->getParameter('upload_directory'),
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }
                        //$annoucement = new Annoucement();
                        $annoucement->setPictures($newFilename);
                        /*if ($file_name) { // for example
                            $directory = $file_uploader->getTargetDirectory();
                            //$full_path = $directory . '/' . $file_name;
                            $entityManager = $doctrine->getManager();

                            $entityManager->persist($annoucement);
                            $entityManager->flush();
                            return $this->redirectToRoute('app_annoucement');
                            // Do what you want with the full path file...
                        } else {
                            $this->addFlash('error', "L\'annonce n\'a pas bien été ajouté à la liste ! ");
                        }*/
    /*}
                        if ($new) {
                            $message = " a été mis à jour avec succès";
                        } else {
                            $message = " a été ajouté avec succès";
                            $annoucement->setCreatedBy($this->getUser());
                        }
                        $entityManager = $doctrine->getManager();

                        $entityManager->persist($annoucement);
                        $entityManager->flush();
                        if ($new) {
                            // On a créer notre evenenement
                            $addAnnoucementEvent = new AddAnnoucementEvent($annoucement);
                            // On va maintenant dispatcher cet événement
                            $this->dispatcher->dispatch($addAnnoucementEvent, AddAnnoucementEvent::ADD_ANNOUCEMENT_EVENT);
                        }

                        $this->addFlash('success', "L\'annonce a pas bien été ajouté à la liste ! $message");
                        return $this->redirectToRoute('app_annoucement', array('id' => $annoucement->getId()));
                    }
                    //dd($form);
                    //$this->service->saveData($form, $doctrine);
                    return $this->render('annoucement/addFormAnnoucement.html.twig', [
                        'form' => $form->createView(),
                        'annoucements' => $annoucement,
                    ]);            // Why not read the content or parse it !!!
                }*/


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
}
