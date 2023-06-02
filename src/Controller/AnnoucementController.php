<?php

namespace App\Controller;

use App\Entity\Annoucement;
//use App\service\FileUploader;
use App\Form\AddAnnoucementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    }

    #[Route('/formAddAnnoucement', name: 'app_AddAnnoucement')]
    public function addAnnoucement(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $annoucement = new Annoucement();

        $form = $this->createForm(AddAnnoucementType::class, $annoucement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('Image')->getData();
            //dd($form['Product_Image']->getData());
            //dd($file);

            if ($file) {
                $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($file_name);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
                $this->addFlash('success', "Il y a bien un fichier image! ");

                try {

                    $file->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                    $this->addFlash('success', "L\'annonce a pas bien été ajouté à la liste ! ");
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                //$annoucement = new Annoucement();
                $annoucement->setImage($newFilename);
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
            }
            $entityManager = $doctrine->getManager();

            $entityManager->persist($annoucement);
            $entityManager->flush();
            $this->addFlash('success', "L\'annonce a pas bien été ajouté à la liste ! ");
            return $this->redirectToRoute('app_annoucement');
            //dd($form);
            //$this->service->saveData($form, $doctrine);
        }
        return $this->render('annoucement/addFormAnnoucement.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Formulaire',
        ]);            // Why not read the content or parse it !!!
    }
}
