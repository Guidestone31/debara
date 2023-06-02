/* class AnnoucementController extends AbstractController { public function __construct(public AddAnnoucementType $service) { } #[Route('/annoucement', name: 'app_annoucement' )] public function findAllAnnoucement(ManagerRegistry $entityManager): Response { $mixRepository=$entityManager->getRepository(Annoucement::class);
$annoucement = $mixRepository->findAll();
//dd($annoucement);
//dd($mixRepository);
return $this->render('annoucement/index.html.twig', ['controlle_name' => 'Nos annonces :', 'annoucements' => $annoucement]);
$genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
$mixes = $this->mixRepository->findAll();
return $this->render('annoucement/index.html.twig', [
'controller_name' => 'AnnoucementController', 'annoucement_list' => $result
]);
public function index(ManagerRegistry $doctrine): Response
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
'form' => $form,
'controller_name' => 'Formulaire',
]);
//$builder->add('email', 'email');
/*$builder->add('plainPassword', 'repeated', array(
'Product_Name' => 'name',
'Product_Category' => 'category',
'Product_Price' => 'price',
'Product_Description' => 'description',
));

//Ajouter l'operation d'insertion de l'utilisateur avec "persist" si l'id existe il va
//automaitiquement mettre à jour si non il ajoute l'utilisateur en bd

//$entityManager->persist($annoucement);

//Execute la transaction
/*$entityManager->flush();
$this->addFlash('success', "L'annonce a bien été ajouté");

return $this->render('annoucement/addAnnoucement.html.twig', [
// 'utilisateur' => $utilisateur,
]);
}
}
<!--<div class="form-group">
														<label for="inputAddress">{{  'product_name' }}</label>
														<input type="text" class="form-control" id="inputAddress" placeholder="Nom de l'article">
													</div>
													<div class="form-group">
														<label for="inputAddress2">{{  'product_category' }}</label>
														<input type="text" class="form-control" id="inputAddress2" placeholder="Catégorie">
													</div>
													<div class="form-group">
														<label for="inputAddress">{{  'product_price' }}</label>
														<input type="number" class="form-control" id="inputAddress" placeholder="Prix">
													</div>
													<div class="form-group">
														<label for="exampleFormControlTextarea1">{{  'product_description' }}</label>
														<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description de l'article"></textarea>
													</div>
												</div>
												<button type="submit" class="btn btn-primary">Sign in</button>-->
*/
/*$annoucement = new Annoucement();
$annoucement->setProductName($data['Product_Name']);
$annoucement->setProductCategory($data['Product_Category']);
$annoucement->setProductDescription($data['Product_Description']);
$annoucement->setProductPrice($data['Product_Price']);
$annoucement->setProductImage($data['Product_Image']);*/

/* $uploadedFile = $form['image_realisation']->getData();

if ($uploadedFile) {
$destination = $this->getParameter('kernel.project_dir') . '/public/assert/';

$originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

$newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

$uploadedFile->move(
$destination,
$newFilename
);
//$image->setImageFile($newFilename);
//$realisation->addImage($image);
}



$brochureFile = $form->get('Product_Image')->getData();

if ($brochureFile) {
$originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
// this is needed to safely include the file name as part of the URL
$safeFilename = $slugger->slug($originalFilename);
$newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

// Move the file to the directory where brochures are stored
try {
$brochureFile->move(
$this->getParameter('brochures_directory'),
$newFilename
);
} catch (FileException $e) {
// ... handle exception if something happens during file upload
}
$annoucement->setProductImage($newFilename);


$file = $annoucement->getProductImage();
$fileName = md5(uniqid()) . '.' . $file->guessExtension();
$file->move($this->getParameter('photos_directory'), $fileName);
$annoucement->setProductImage($fileName);
*/
# This file is the entry point to configure your own services.
# Files in the packages/ subdirectory configure your dependencies.

# Put parameters here that don't need to change on each machine where the app is deployed
# https://symfony.com/doc/current/best_practices.html#use-parameters-for-application-configuration
parameters:
upload_directory: '%kernel.project_dir%/public/uploads/annonces'
services:
# default configuration for services in *this* file
_defaults:
autowire: true # Automatically injects dependencies in your services.
autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
# makes classes in src/ available to be used as services
# this creates a service per class whose id is the fully-qualified class name
App\:
resource: '../src/'
exclude:
- '../src/DependencyInjection/'
- '../src/Entity/'
- '../src/Kernel.php'
# add more service definitions when explicit configuration is needed
# please note that last definitions always *replace* previous ones
App\service\FileUploader:
arguments:
$targetDirectory: '%upload_directory%'
