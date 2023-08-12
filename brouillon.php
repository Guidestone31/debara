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



////////////////////////new.html.twig/////////////////////////
<div class="example-wrapper">
    <h1>
        Création de profile
    </h1>
    {#{{ form_start(form) }}
		{#{{ form_row(form.Picture) }}#}
    <label class="header">Profile Photo:</label>
    <input id="image" type="file" name="profile_photo" placeholder="Photo" required="" capture>
    <img src="..." alt="..." class="img-thumbnail">
    {#{{ form_label(form.Product_Image) }}
																																																																											{{ form_widget(form.Product_Image) }}
																																																																											{{ form_errors(form.Product_Image) }}#}
    {# your custom code for rendering the form #}
    {# if you leave default then it should render with bad styles etc. #}
    {{ form_end(form) }}#}
    <div class="col-3">
        <div class="card" style="width: 18rem;"></div>
    </div>
</div>

//////////////////////index.html.twig Login///////////////////////////

<button type="submit">login</button>
<label for="username">Email:</label>
<input type="text" id="username" name="_username" value="{{ last_username }}">

<label for="password">Password:</label>
<input type="password" id="password" name="_password">

{# If you want to control the URL the user is redirected to on success
																																								        <input type="hidden" name="_target_path" value="/account"> #}

<button type="submit">login</button>

/////////////////////////////LoginFormAuthentificator.php////////////////////////////


/**
* Used to upgrade (rehash) the user's password automatically over time.
*/
/*
public function getPassword($credentials): ?string
{
return $credentials['password'];
}
*/


/////////////////////////////////// ajax region departement /////////////////////////////
{% endblock %}
{##}
{#
	window.onload = () => { // On va chercher la région
	let region = document.querySelector("#add_annoucement_regions");

	region.addEventListener("change", function () {

	let form = this.closest("form");
	console.log(form);
	let data = this.name + "=" + this.value;
	console.log(data + " data");

	fetch(form.action, {
	method: form.getAttribute("method"),
	body: data,
	headers: {
	"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
	}
	}).then(response => response.text()).then((html) => {
	console.log(html + " 1er html")
	let content = document.createElement("html");
	content.innerHTML = html;
	console.log(html + "2eme html")
	let nouveauSelect = content.querySelector("#add_annoucement_departements");
	console.log(nouveauSelect + " Nouveau select");
	document.querySelector("#add_annoucement_departements").replaceWith(nouveauSelect);

	let departement = document.querySelector("#add_annoucement_departements");
	departement.addEventListener("change", function () {

	let form2 = departement.closest("form");
	console.log(form2);
	let data2 = departement.name + "=" + departement.value;
	console.log(data2 + " data");
	fetch(form.action, {
	method: form.getAttribute("method"),
	body: data,
	headers: {
	"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
	}
	}).then(response => response.text()).then((html) => {
	console.log(html + " 1er html")
	let content2 = document.createElement("html");
	content.innerHTML = html;
	console.log(html + "2eme html")
	let nouveauSelect2 = content2.querySelector("#add_annoucement_villesfrance");
	console.log(nouveauSelect2 + " Nouveau select");
	document.querySelector("#add_annoucement_villesfrance").replaceWith(nouveauSelect2);

	});

	})

	});

	});
	}
	<script>
		window.onload = () => { // On va chercher la région

let departement = document.querySelector("#add_annoucement_departements");
departement.addEventListener("change", function () {

let formV = this.closest("form");
let dataV = this.name + "=" + this.value;

fetch(formV.action, {
method: form.getAttribute("method"),
body: dataV,
headers: {
"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
}
}).then(response => response.text()).then((html) => {
let contentV = document.createElement("html");
contentV.innerHTML = html;
let nouveauSelectV = contentV.querySelector("#add_annoucement_villesfrance");
document.querySelector("#add_annoucement_villesfrance").replaceWith(nouveauSelectV);
});
});
}
	</script>
	#}
$formModifier = function (FormInterface $form, Regions $region = null, Departements $dep = null) {
$departement = null === $region ? [] : $region->getDepartements();
$form->add('departements', EntityType::class, [
'class' => Departements::class,
'choices' => $departement,
'choice_label' => 'nom',
'placeholder' => 'Départements (choisir une région)',
'label' => 'Départements',
'required' => false
]);
$villesfrance = null === $dep ? [] : $dep->getVillesFrance();
$form->add('villesfrance', EntityType::class, [
'class' => VillesFrance::class,
'choices' => $villesfrance,
'choice_label' => 'villeNom',
'placeholder' => 'Ville (choisir une région)',
'label' => 'Ville',
'required' => false
]);
};

$builder->get('regions')->addEventListener(
FormEvents::POST_SUBMIT,
function (FormEvent $event) use ($formModifier) {
$region = $event->getForm()->getData();
$formModifier($event->getForm()->getParent(), $region);
}
);
$builder->get('departements')->addEventListener(
FormEvents::POST_SUBMIT,
function (FormEvent $event) use ($formModifier) {
$dep = $event->getForm()->getData();
$formModifier($event->getForm()->getParent(), $dep);
}
);


///////////////////////// Code Discords ////////////////////////////


<> ShareMyCode.io
    Ajouter un code
    Connexion
    Inscription
    Voici votre URL de partage https://sharemycode.io/c/55b1db1 (Cliquer pour copier)
    Nom du fichier : ListernerForm exemple
    <?php
    /*

namespace App\Form;

use App\Entity\Category;
use App\Entity\Form;
use App\Entity\SecondCategory;
use App\Entity\SubCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormEntityFormType extends AbstractType
{*/
    /* @var FieldsFormType
    */
    /*
    private FieldsFormType $fieldsFormType;

    public function __construct(FieldsFormType $fieldsFormType)
    {
        $this->fieldsFormType = $fieldsFormType;
    }



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'required' => true,
                'placeholder' => 'Select one category',
            ])
            ->add('fields', CollectionType::class, [
                'entry_type' => FieldsFormType::class,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false

            ])
        ;

        $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();

                $this->addSecondCategoryField($form->getParent(), $form->getData());
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                /* @var Form $formObject */
    /*
    $formObject = $event->getData();

    $form = $event->getForm();

    if ($formObject) {
        $category = $formObject->getCategory();
        $secondCategory = $formObject->getSecondCategory();
        $subCategory = $formObject->getSubCategory();

        $this->addSecondCategoryField($form, $category);
        $this->addSubCategoryField($form, $secondCategory);

        $form->get('category')->setData($category);
        $form->get('secondCategory')->setData($secondCategory);

        if ($subCategory !== null) {
            $form->get('subCategory')->setData($subCategory);
        }

    } else {
        $this->addSecondCategoryField($form, null);
        $this->addSubCategoryField($form, null);
    }
                }
            );

        }

        private function addSecondCategoryField(FormInterface $form, ?Category $category): void
        {
            $secondCategory = null === $category ? [] : $category->getSecondCategory();

            $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
                'secondCategory',
                EntityType::class,
                null,
                [
    'class' => SecondCategory::class,
    'choices' => $secondCategory,
    'choice_label' => 'name',
    'auto_initialize' => false,
    'placeholder' => 'Select one second category',
    'empty_data' => ''
                ]
            );

            $builder->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) {
    $form = $event->getForm();
    $this->addSubCategoryField($form->getParent(), $form->getData());
                }
            );

            $form->add($builder->getForm());
        }

        private function addSubCategoryField(FormInterface $form, ?SecondCategory $secondCategory): void
        {
            if ($secondCategory !== null) {
                if ($secondCategory->isHaveSubCategories() === true) {
    $form->add(
        'subCategory',
        EntityType::class,
        [
            'class' => SubCategory::class,
            'choices' => $secondCategory->getSubCategories(),
            'choice_label' => 'name',
            'required' => true,
            'placeholder' => 'Select one sub-category',
            'empty_data' => ''
        ]
    );

                }
                $form->add(
    'name',
    TextType::class,
    [
        'required' => true,
        'empty_data' => ''
    ]
                );
            }

        }

        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Form::class,
            ]);
        }
    }*/
    /*
    {% block javascripts %}

        <script>
            // window.onload = () => { // On va chercher la région
    let region = document.querySelector("#add_annoucement_regions");

    region.addEventListener("change", function handler1() {

    let form = this.closest("form");
    let data = this.name + "=" + this.value;

    fetch(form.action, {
    method: form.getAttribute("method"),
    body: data,
    headers: {
    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
    }).then(response => response.text()).then((html) => {
    let content = document.createElement("html");
    content.innerHTML = html;
    let nouveauSelect = content.querySelector("#add_annoucement_departement_id");
    document.querySelector("#add_annoucement_departement_id").replaceWith(nouveauSelect);
    })

    });

    let departement = document.querySelector("#add_annoucement_departement_id");

    departement.addEventListener("change", function handler2() {

    let formV = departement.closest("form");
    let dataV = departement.name + "=" + departement.value;

    fetch(formV.action, {
    method: form.getAttribute("method"),
    body: dataV,
    headers: {
    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
    }).then(response => response.text()).then((html) => {
    let contentV = document.createElement("html");
    contentV.innerHTML = html;
    let nouveauSelectV = contentV.querySelector("#add_annoucement_villesfrance");
    document.querySelector("#add_annoucement_villesfrance").replaceWith(nouveauSelectV);
    console.log(nouveauSelect);

    })

    });
    // }




    		var $regions = $('#add_annoucement_regions');
var $departements = $('#add_annoucement_departement_id');

$(document).on("change", "#add_annoucement_regions", function () {

var $form = $(this).closest('form');
// Simulate form data, but only include the selected sport value.
var data = {};
data[$regions.attr('name')] = $regions.val();
// Submit data via AJAX to the form's action path.
$.ajax({
url: $form.attr('action'),
type: $form.attr('method'),
data: data,
success: function (html) { // Replace current position field ...
$('#add_annoucement_departement_id').replaceWith(
// ... with the returned one from the AJAX response.
$(html).find('#add_annoucement_departement_id')
);

// Position field now displays the appropriate positions.
}
});

});
$(document).on("change", "#add_annoucement_departement_id", function () { // ... retrieve the corresponding form.

var $departement = $('#add_annoucement_departement_id');

var $form = $(this).closest('form');
// Simulate form data, but only include the selected sport value.
var data = {};

data[$departement.attr('name')] = $departement.val();
// Submit data via AJAX to the form's action path.
$.ajax({
url: $form.attr('action'),
type: $form.attr('method'),
data: data,
success: function (html) { // Replace current position field ...
$('#add_annoucement_villesfrance').replaceWith(
// ... with the returned one from the AJAX response.
$(html).find('#add_annoucement_villesfrance')
);
// Position field now displays the appropriate positions.
}
});
});
        </script>
    {% endblock %}
    ///////////////////////////// Methode FormType //////////////////////////////////

        private FormFactoryInterface $factory;
    /**
     *@var array<string, mixed>
     */
    /*private $dependencies = [];*//*
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $this->factory = $builder->getFormFactory();

        $builder->add('regions', EnumType::class, [
            'class' => Regions::class,
            'choice_label' => fn (Regions $region): string => $region->getNom(),
            'placeholder' => 'Which regions',
            //'autocomplete' => true,
        ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
        $builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);

        $builder->get('regions')->addEventListener(FormEvents::POST_SUBMIT, [$this, 'storeDependencies']);
        $builder->get('regions')->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitMeal']);
    public function addDepartement(FormInterface $form, ?Regions $regions): void
    }
    {
        $Mainregions = $this->factory
        ->createNamedBuilder('departements', EnumType::class, $regions, [
            'class' => Departements::class,
            'placeholder' => null === $regions ? 'Select a regions first' : sprintf('What\'s for %s?', $regions->getNom()),
            'choices' => $regions->getNom(),
            'choice_label' => fn (Departements $departements): string => $departements->getNom(),
            'disabled' => null === $regions,

            'invalid_message' => false,
            'autocomplete' => true,
            'auto_initialize' => false,
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'storeDependencies'])
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitVille']);

            $form->add($Mainregions->getForm());
        }

        public function addVilleNom(FormInterface $form, ?Departements $departements): void
        {
            if ($departements === null) {
                return;
            }

            $form->add('villesfrance', EnumType::class, [
                'class' => VillesFrance::class,
                'placeholder' => 'What city ?',
                'choice_label' => fn (VillesFrance $villesfrance): string => $villesfrance->getVilleNom(),
                'required' => true,
                'autocomplete' => true,
            ]);
        }

        public function onPreSetData(FormEvent $event): void
        {
            $data = $event->getData();
            $this->addDepartement($event->getForm(), $data?->getAnnoucement());
            $this->addVilleNom($event->getForm(), $data?->getVilleNom());
        }
        public function onPostSubmitVille(FormEvent $event): void
        {
            $this->addVilleNom(
                $event->getForm()->getParent(),
                $this->dependencies['departement'],
            );
        }

        public function onPostSubmitRegions(FormEvent $event): void
        {
            $this->addDepartement(
                $event->getForm()->getParent(),
                $this->dependencies['departements'],
            );
        }
        public function onPostSubmit(FormEvent $event): void
        {
            $this->dependencies = [];
        }

        public function storeDependencies(FormEvent $event): void
        {
            $this->dependencies[$event->getForm()->getName()] = $event->getForm()->getData();
        }
        {% block javascripts %}
        <script>
        window.onload = () => { // On va chercher la région
            let region = document.querySelector("#add_annoucement_regions");
            let departement = document.querySelector("#add_annoucement_departement_id");

            region.addEventListener("change", function () {

                let form = this.closest("form");
                let data = this.name + "=" + this.value;

                fetch(form.action, {
                    method: form.getAttribute("method"),
                    body: data,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                    }
                }).then(response => response.text()).then((html) => {
                    let content = document.createElement("html");
                    content.innerHTML = html;
                    let nouveauSelect = content.querySelector("#add_annoucement_departement_id");
                    document.querySelector("#add_annoucement_departement_id").replaceWith(nouveauSelect);
                })

            });

            console.log(departement);

            region.addEventListener("change", function () {

                let form = this.closest("form");
                let data = this.name + "=" + this.value;

                fetch(form.action, {
                    method: form.getAttribute("method"),
                    body: data,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                    }
                }).then(response => response.text()).then((html) => {
                    let content = document.createElement("html");
                    content.innerHTML = html;
                    let nouveauSelect = content.querySelector("#add_annoucement_villesfrance");
                    document.querySelector("#add_annoucement_villesfrance").replaceWith(nouveauSelect);
                })

            });


        }
        </script>
        {% endblock %}


        */
    /* public function saveData(FormInterface $form)
    {
        $now = new \DateTime('now');
        $annoucement = new Annoucement();

        $task = $form->getData();
        $task->setCreatedAt($now);
        $task->setUpdatedAt($now);

        /*$entityManager = $doctrine->getManager();
        $entityManager->persist($annoucement);
        $entityManager->flush();
    }*/
    /*        $formModifier2 = function (FormInterface $form2, Departements $dep = null) {
        $villesfrance = null === $dep ? [] : $dep->getVillesFrance();
        $form2->add('villesfrance', EntityType::class, [
            'class' => VillesFrance::class,
            'choices' => $villesfrance,
            'choice_label' => 'villeNom',
            'placeholder' => 'Ville (choisir une région)',
            'label' => 'Ville',
            'required' => false
        ]);
    };
    $builder->get('departements')->addEventListener(
        FormEvents::POST_SUBMIT,
        function (FormEvent $event) use ($formModifier2) {
            $dep = $event->getForm()->getData();
            $formModifier2($event->getForm()->getParent(), $dep);
        }
    );*/

    /*
    /*->add('Departements', EntityType::class, [
                     'placeholder' => 'Départements (choisir une région)',
                     'mapped' => false,
                     'class' => Departements::class,
                     'choice_label' => 'nom',
                     'label' => 'Départements'
                    ])*/
    // ...
    /*
    $form = $this->createForm(UserPasswordType::class);

    $form->handleRequest($request);

    $user = new User();

    if ($form->isSubmitted() && $form->isValid()) {
        if ($password->isPasswordValid($user, $form->get('plainPassword')->getData())) {
            $user->setPassword(
                $password->hashPassword(
                    $user,
                    $form->get('Password')->getData()
                )
            );
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "Le mot de passe a pas bien été modifié ! ");
            return $this->redirectToRoute('app_home');
        } else {
            $this->addFlash('error', "Le mot de passe n'a pas été modifié! ");
            return $this->redirectToRoute('edit_userPassword');
        }
    }

    return $this->render(
        'profile/edit_userPassword.html.twig',
        ['form' => $form->createView()]
    );
    /**
     * @return Collection<int, Picture>
     */




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



    /*
                {% for annoucement in app.user.annoucements %}


                <div class="col-3">
                    <div class="card" style="width: 18rem;">
    <div class="card-body">

        {% for picture in annoucement.pictures %}

            <img src="{{ asset('assets/uploads/annonces/mini/300x300-' ~ annoucement.pictures[0].name ) }}" alt="{{ annoucement.nom }}" class="img-thumbnail">

        {% endfor %}
        <h6 class="card-subtitle mb-2 text-muted">
            {{  annoucement.Description }}</h6>
        <p class="card-text">{{  annoucement.Price  }}
            €</p>
        <a href="{{'/product/'}}" class="card-link">Détail</a>
        <a href="{{ path('app_DelAnnoucement', {id: annoucement.id}) }}" class="card-link">
            Suprimer
        </a>
    </div>
                    </div>
                </div>
            {% endfor %}#}
/*var x = document.getElementById("location");
fonction getPreciseLocation() {
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(showExactPosition)
}
autre {
x.innerHTML = "La géolocalisation n'est pas prise en charge"
}
}
fonction showExactPosition(position) {
x.innerHTML = "Latitude : " + position.coords.latitude + " br Longitude : " + position.coords.longitude;
}*/
