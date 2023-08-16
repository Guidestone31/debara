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
    /////////////////composer.lock///////////////////////////////
    /*
    {
        "_readme": [
            "This file locks the dependencies of your project to a known state",
            "Read more about it at https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies",
            "This file is @generated automatically"
        ],
        "content-hash": "e18d36b8c6b8d05fa0f2e84b9ae59fbb",
        "packages": [
            {
                "name": "api-platform/core",
                "version": "v3.1.14",
                "source": {
                    "type": "git",
                    "url": "https://github.com/api-platform/core.git",
                    "reference": "3e3595dc8bab1c7779beaaeb97711bfa8857285f"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/api-platform/core/zipball/3e3595dc8bab1c7779beaaeb97711bfa8857285f",
                    "reference": "3e3595dc8bab1c7779beaaeb97711bfa8857285f",
                    "shasum": ""
                },
                "require": {
                    "doctrine/inflector": "^1.0 || ^2.0",
                    "php": ">=8.1",
                    "psr/cache": "^1.0 || ^2.0 || ^3.0",
                    "psr/container": "^1.0 || ^2.0",
                    "symfony/deprecation-contracts": "^3.1",
                    "symfony/http-foundation": "^6.1",
                    "symfony/http-kernel": "^6.1",
                    "symfony/property-access": "^6.1",
                    "symfony/property-info": "^6.1",
                    "symfony/serializer": "^6.1",
                    "symfony/web-link": "^6.1",
                    "willdurand/negotiation": "^3.0"
                },
                "conflict": {
                    "doctrine/common": "<3.2.2",
                    "doctrine/dbal": "<2.10",
                    "doctrine/mongodb-odm": "<2.4",
                    "doctrine/orm": "<2.14.0",
                    "doctrine/persistence": "<1.3",
                    "elasticsearch/elasticsearch": ">=8.0",
                    "phpspec/prophecy": "<1.15",
                    "phpunit/phpunit": "<9.5",
                    "symfony/service-contracts": "<3",
                    "symfony/var-exporter": "<6.1.1"
                },
                "require-dev": {
                    "behat/behat": "^3.1",
                    "behat/mink": "^1.9",
                    "doctrine/cache": "^1.11 || ^2.1",
                    "doctrine/common": "^3.2.2",
                    "doctrine/dbal": "^3.4.0",
                    "doctrine/doctrine-bundle": "^1.12 || ^2.0",
                    "doctrine/mongodb-odm": "^2.2",
                    "doctrine/mongodb-odm-bundle": "^4.0",
                    "doctrine/orm": "^2.14",
                    "elasticsearch/elasticsearch": "^7.11.0",
                    "friends-of-behat/mink-browserkit-driver": "^1.3.1",
                    "friends-of-behat/mink-extension": "^2.2",
                    "friends-of-behat/symfony-extension": "^2.1",
                    "guzzlehttp/guzzle": "^6.0 || ^7.0",
                    "jangregor/phpstan-prophecy": "^1.0",
                    "justinrainbow/json-schema": "^5.2.1",
                    "phpspec/prophecy-phpunit": "^2.0",
                    "phpstan/extension-installer": "^1.1",
                    "phpstan/phpdoc-parser": "^1.13",
                    "phpstan/phpstan": "^1.1",
                    "phpstan/phpstan-doctrine": "^1.0",
                    "phpstan/phpstan-phpunit": "^1.0",
                    "phpstan/phpstan-symfony": "^1.0",
                    "psr/log": "^1.0 || ^2.0 || ^3.0",
                    "ramsey/uuid": "^3.9.7 || ^4.0",
                    "ramsey/uuid-doctrine": "^1.4 || ^2.0",
                    "soyuka/contexts": "v3.3.9",
                    "soyuka/stubs-mongodb": "^1.0",
                    "symfony/asset": "^6.1",
                    "symfony/browser-kit": "^6.1",
                    "symfony/cache": "^6.1",
                    "symfony/config": "^6.1",
                    "symfony/console": "^6.1",
                    "symfony/css-selector": "^6.1",
                    "symfony/dependency-injection": "^6.1.12",
                    "symfony/doctrine-bridge": "^6.1",
                    "symfony/dom-crawler": "^6.1",
                    "symfony/error-handler": "^6.1",
                    "symfony/event-dispatcher": "^6.1",
                    "symfony/expression-language": "^6.1",
                    "symfony/finder": "^6.1",
                    "symfony/form": "^6.1",
                    "symfony/framework-bundle": "^6.1",
                    "symfony/http-client": "^6.1",
                    "symfony/intl": "^6.1",
                    "symfony/maker-bundle": "^1.24",
                    "symfony/mercure-bundle": "*",
                    "symfony/messenger": "^6.1",
                    "symfony/phpunit-bridge": "^6.1",
                    "symfony/routing": "^6.1",
                    "symfony/security-bundle": "^6.1",
                    "symfony/security-core": "^6.1",
                    "symfony/twig-bundle": "^6.1",
                    "symfony/uid": "^6.1",
                    "symfony/validator": "^6.1",
                    "symfony/web-profiler-bundle": "^6.1",
                    "symfony/yaml": "^6.1",
                    "twig/twig": "^1.42.3 || ^2.12 || ^3.0",
                    "webonyx/graphql-php": "^14.0 || ^15.0"
                },
                "suggest": {
                    "doctrine/mongodb-odm-bundle": "To support MongoDB. Only versions 4.0 and later are supported.",
                    "elasticsearch/elasticsearch": "To support Elasticsearch.",
                    "ocramius/package-versions": "To display the API Platform's version in the debug bar.",
                    "phpstan/phpdoc-parser": "To support extracting metadata from PHPDoc.",
                    "psr/cache-implementation": "To use metadata caching.",
                    "ramsey/uuid": "To support Ramsey's UUID identifiers.",
                    "symfony/cache": "To have metadata caching when using Symfony integration.",
                    "symfony/config": "To load XML configuration files.",
                    "symfony/expression-language": "To use authorization features.",
                    "symfony/http-client": "To use the HTTP cache invalidation system.",
                    "symfony/messenger": "To support messenger integration.",
                    "symfony/security": "To use authorization features.",
                    "symfony/twig-bundle": "To use the Swagger UI integration.",
                    "symfony/uid": "To support Symfony UUID/ULID identifiers.",
                    "symfony/web-profiler-bundle": "To use the data collector.",
                    "webonyx/graphql-php": "To support GraphQL."
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.2.x-dev"
                    },
                    "symfony": {
                        "require": "^6.1"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "ApiPlatform\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Kévin Dunglas",
                        "email": "kevin@dunglas.fr",
                        "homepage": "https://dunglas.fr"
                    }
                ],
                "description": "Build a fully-featured hypermedia or GraphQL API in minutes!",
                "homepage": "https://api-platform.com",
                "keywords": [
                    "Hydra",
                    "JSON-LD",
                    "api",
                    "graphql",
                    "hal",
                    "jsonapi",
                    "openapi",
                    "rest",
                    "swagger"
                ],
                "support": {
                    "issues": "https://github.com/api-platform/core/issues",
                    "source": "https://github.com/api-platform/core/tree/v3.1.14"
                },
                "funding": [
                    {
                        "url": "https://tidelift.com/funding/github/packagist/api-platform/core",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-08-11T14:14:36+00:00"
            },
            {
                "name": "behat/transliterator",
                "version": "v1.5.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/Behat/Transliterator.git",
                    "reference": "baac5873bac3749887d28ab68e2f74db3a4408af"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/Behat/Transliterator/zipball/baac5873bac3749887d28ab68e2f74db3a4408af",
                    "reference": "baac5873bac3749887d28ab68e2f74db3a4408af",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.2"
                },
                "require-dev": {
                    "chuyskywalker/rolling-curl": "^3.1",
                    "php-yaoi/php-yaoi": "^1.0",
                    "phpunit/phpunit": "^8.5.25 || ^9.5.19"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Behat\\Transliterator\\": "src/Behat/Transliterator"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "Artistic-1.0"
                ],
                "description": "String transliterator",
                "keywords": [
                    "i18n",
                    "slug",
                    "transliterator"
                ],
                "support": {
                    "issues": "https://github.com/Behat/Transliterator/issues",
                    "source": "https://github.com/Behat/Transliterator/tree/v1.5.0"
                },
                "time": "2022-03-30T09:27:43+00:00"
            },
            {
                "name": "clue/stream-filter",
                "version": "v1.6.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/clue/stream-filter.git",
                    "reference": "d6169430c7731d8509da7aecd0af756a5747b78e"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/clue/stream-filter/zipball/d6169430c7731d8509da7aecd0af756a5747b78e",
                    "reference": "d6169430c7731d8509da7aecd0af756a5747b78e",
                    "shasum": ""
                },
                "require": {
                    "php": ">=5.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3 || ^5.7 || ^4.8.36"
                },
                "type": "library",
                "autoload": {
                    "files": [
                        "src/functions_include.php"
                    ],
                    "psr-4": {
                        "Clue\\StreamFilter\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Christian Lück",
                        "email": "christian@clue.engineering"
                    }
                ],
                "description": "A simple and modern approach to stream filtering in PHP",
                "homepage": "https://github.com/clue/php-stream-filter",
                "keywords": [
                    "bucket brigade",
                    "callback",
                    "filter",
                    "php_user_filter",
                    "stream",
                    "stream_filter_append",
                    "stream_filter_register"
                ],
                "support": {
                    "issues": "https://github.com/clue/stream-filter/issues",
                    "source": "https://github.com/clue/stream-filter/tree/v1.6.0"
                },
                "funding": [
                    {
                        "url": "https://clue.engineering/support",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/clue",
                        "type": "github"
                    }
                ],
                "time": "2022-02-21T13:15:14+00:00"
            },
            {
                "name": "doctrine/annotations",
                "version": "2.0.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/annotations.git",
                    "reference": "e157ef3f3124bbf6fe7ce0ffd109e8a8ef284e7f"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/annotations/zipball/e157ef3f3124bbf6fe7ce0ffd109e8a8ef284e7f",
                    "reference": "e157ef3f3124bbf6fe7ce0ffd109e8a8ef284e7f",
                    "shasum": ""
                },
                "require": {
                    "doctrine/lexer": "^2 || ^3",
                    "ext-tokenizer": "*",
                    "php": "^7.2 || ^8.0",
                    "psr/cache": "^1 || ^2 || ^3"
                },
                "require-dev": {
                    "doctrine/cache": "^2.0",
                    "doctrine/coding-standard": "^10",
                    "phpstan/phpstan": "^1.8.0",
                    "phpunit/phpunit": "^7.5 || ^8.5 || ^9.5",
                    "symfony/cache": "^5.4 || ^6",
                    "vimeo/psalm": "^4.10"
                },
                "suggest": {
                    "php": "PHP 8.0 or higher comes with attributes, a native replacement for annotations"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Common\\Annotations\\": "lib/Doctrine/Common/Annotations"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    }
                ],
                "description": "Docblock Annotations Parser",
                "homepage": "https://www.doctrine-project.org/projects/annotations.html",
                "keywords": [
                    "annotations",
                    "docblock",
                    "parser"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/annotations/issues",
                    "source": "https://github.com/doctrine/annotations/tree/2.0.1"
                },
                "time": "2023-02-02T22:02:53+00:00"
            },
            {
                "name": "doctrine/cache",
                "version": "2.2.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/cache.git",
                    "reference": "1ca8f21980e770095a31456042471a57bc4c68fb"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/cache/zipball/1ca8f21980e770095a31456042471a57bc4c68fb",
                    "reference": "1ca8f21980e770095a31456042471a57bc4c68fb",
                    "shasum": ""
                },
                "require": {
                    "php": "~7.1 || ^8.0"
                },
                "conflict": {
                    "doctrine/common": ">2.2,<2.4"
                },
                "require-dev": {
                    "cache/integration-tests": "dev-master",
                    "doctrine/coding-standard": "^9",
                    "phpunit/phpunit": "^7.5 || ^8.5 || ^9.5",
                    "psr/cache": "^1.0 || ^2.0 || ^3.0",
                    "symfony/cache": "^4.4 || ^5.4 || ^6",
                    "symfony/var-exporter": "^4.4 || ^5.4 || ^6"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Common\\Cache\\": "lib/Doctrine/Common/Cache"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    }
                ],
                "description": "PHP Doctrine Cache library is a popular cache implementation that supports many different drivers such as redis, memcache, apc, mongodb and others.",
                "homepage": "https://www.doctrine-project.org/projects/cache.html",
                "keywords": [
                    "abstraction",
                    "apcu",
                    "cache",
                    "caching",
                    "couchdb",
                    "memcached",
                    "php",
                    "redis",
                    "xcache"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/cache/issues",
                    "source": "https://github.com/doctrine/cache/tree/2.2.0"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fcache",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-05-20T20:07:39+00:00"
            },
            {
                "name": "doctrine/collections",
                "version": "2.1.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/collections.git",
                    "reference": "3023e150f90a38843856147b58190aa8b46cc155"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/collections/zipball/3023e150f90a38843856147b58190aa8b46cc155",
                    "reference": "3023e150f90a38843856147b58190aa8b46cc155",
                    "shasum": ""
                },
                "require": {
                    "doctrine/deprecations": "^1",
                    "php": "^8.1"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^10.0",
                    "ext-json": "*",
                    "phpstan/phpstan": "^1.8",
                    "phpstan/phpstan-phpunit": "^1.0",
                    "phpunit/phpunit": "^9.5",
                    "vimeo/psalm": "^5.11"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Common\\Collections\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    }
                ],
                "description": "PHP Doctrine Collections library that adds additional functionality on top of PHP arrays.",
                "homepage": "https://www.doctrine-project.org/projects/collections.html",
                "keywords": [
                    "array",
                    "collections",
                    "iterators",
                    "php"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/collections/issues",
                    "source": "https://github.com/doctrine/collections/tree/2.1.3"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fcollections",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-06T15:15:36+00:00"
            },
            {
                "name": "doctrine/common",
                "version": "3.4.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/common.git",
                    "reference": "8b5e5650391f851ed58910b3e3d48a71062eeced"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/common/zipball/8b5e5650391f851ed58910b3e3d48a71062eeced",
                    "reference": "8b5e5650391f851ed58910b3e3d48a71062eeced",
                    "shasum": ""
                },
                "require": {
                    "doctrine/persistence": "^2.0 || ^3.0",
                    "php": "^7.1 || ^8.0"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^9.0 || ^10.0",
                    "doctrine/collections": "^1",
                    "phpstan/phpstan": "^1.4.1",
                    "phpstan/phpstan-phpunit": "^1",
                    "phpunit/phpunit": "^7.5.20 || ^8.5 || ^9.0",
                    "squizlabs/php_codesniffer": "^3.0",
                    "symfony/phpunit-bridge": "^6.1",
                    "vimeo/psalm": "^4.4"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Common\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    },
                    {
                        "name": "Marco Pivetta",
                        "email": "ocramius@gmail.com"
                    }
                ],
                "description": "PHP Doctrine Common project is a library that provides additional functionality that other Doctrine projects depend on such as better reflection support, proxies and much more.",
                "homepage": "https://www.doctrine-project.org/projects/common.html",
                "keywords": [
                    "common",
                    "doctrine",
                    "php"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/common/issues",
                    "source": "https://github.com/doctrine/common/tree/3.4.3"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fcommon",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-10-09T11:47:59+00:00"
            },
            {
                "name": "doctrine/dbal",
                "version": "3.6.5",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/dbal.git",
                    "reference": "96d5a70fd91efdcec81fc46316efc5bf3da17ddf"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/dbal/zipball/96d5a70fd91efdcec81fc46316efc5bf3da17ddf",
                    "reference": "96d5a70fd91efdcec81fc46316efc5bf3da17ddf",
                    "shasum": ""
                },
                "require": {
                    "composer-runtime-api": "^2",
                    "doctrine/cache": "^1.11|^2.0",
                    "doctrine/deprecations": "^0.5.3|^1",
                    "doctrine/event-manager": "^1|^2",
                    "php": "^7.4 || ^8.0",
                    "psr/cache": "^1|^2|^3",
                    "psr/log": "^1|^2|^3"
                },
                "require-dev": {
                    "doctrine/coding-standard": "12.0.0",
                    "fig/log-test": "^1",
                    "jetbrains/phpstorm-stubs": "2023.1",
                    "phpstan/phpstan": "1.10.21",
                    "phpstan/phpstan-strict-rules": "^1.5",
                    "phpunit/phpunit": "9.6.9",
                    "psalm/plugin-phpunit": "0.18.4",
                    "squizlabs/php_codesniffer": "3.7.2",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/console": "^4.4|^5.4|^6.0",
                    "vimeo/psalm": "4.30.0"
                },
                "suggest": {
                    "symfony/console": "For helpful console commands such as SQL execution and import of files."
                },
                "bin": [
                    "bin/doctrine-dbal"
                ],
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\DBAL\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    }
                ],
                "description": "Powerful PHP database abstraction layer (DBAL) with many features for database schema introspection and management.",
                "homepage": "https://www.doctrine-project.org/projects/dbal.html",
                "keywords": [
                    "abstraction",
                    "database",
                    "db2",
                    "dbal",
                    "mariadb",
                    "mssql",
                    "mysql",
                    "oci8",
                    "oracle",
                    "pdo",
                    "pgsql",
                    "postgresql",
                    "queryobject",
                    "sasql",
                    "sql",
                    "sqlite",
                    "sqlserver",
                    "sqlsrv"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/dbal/issues",
                    "source": "https://github.com/doctrine/dbal/tree/3.6.5"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fdbal",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-17T09:15:50+00:00"
            },
            {
                "name": "doctrine/deprecations",
                "version": "v1.1.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/deprecations.git",
                    "reference": "612a3ee5ab0d5dd97b7cf3874a6efe24325efac3"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/deprecations/zipball/612a3ee5ab0d5dd97b7cf3874a6efe24325efac3",
                    "reference": "612a3ee5ab0d5dd97b7cf3874a6efe24325efac3",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.1 || ^8.0"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^9",
                    "phpstan/phpstan": "1.4.10 || 1.10.15",
                    "phpstan/phpstan-phpunit": "^1.0",
                    "phpunit/phpunit": "^7.5 || ^8.5 || ^9.5",
                    "psalm/plugin-phpunit": "0.18.4",
                    "psr/log": "^1 || ^2 || ^3",
                    "vimeo/psalm": "4.30.0 || 5.12.0"
                },
                "suggest": {
                    "psr/log": "Allows logging deprecations via PSR-3 logger implementation"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Deprecations\\": "lib/Doctrine/Deprecations"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "description": "A small layer on top of trigger_error(E_USER_DEPRECATED) or PSR-3 logging with options to disable all deprecations or selectively for packages.",
                "homepage": "https://www.doctrine-project.org/",
                "support": {
                    "issues": "https://github.com/doctrine/deprecations/issues",
                    "source": "https://github.com/doctrine/deprecations/tree/v1.1.1"
                },
                "time": "2023-06-03T09:27:29+00:00"
            },
            {
                "name": "doctrine/doctrine-bundle",
                "version": "2.10.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/DoctrineBundle.git",
                    "reference": "f28b1f78de3a2938ff05cfe751233097624cc756"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/DoctrineBundle/zipball/f28b1f78de3a2938ff05cfe751233097624cc756",
                    "reference": "f28b1f78de3a2938ff05cfe751233097624cc756",
                    "shasum": ""
                },
                "require": {
                    "doctrine/cache": "^1.11 || ^2.0",
                    "doctrine/dbal": "^3.6.0",
                    "doctrine/persistence": "^2.2 || ^3",
                    "doctrine/sql-formatter": "^1.0.1",
                    "php": "^7.4 || ^8.0",
                    "symfony/cache": "^5.4 || ^6.0",
                    "symfony/config": "^5.4 || ^6.0",
                    "symfony/console": "^5.4 || ^6.0",
                    "symfony/dependency-injection": "^5.4 || ^6.0",
                    "symfony/deprecation-contracts": "^2.1 || ^3",
                    "symfony/doctrine-bridge": "^5.4.19 || ^6.0.7",
                    "symfony/framework-bundle": "^5.4 || ^6.0",
                    "symfony/service-contracts": "^1.1.1 || ^2.0 || ^3"
                },
                "conflict": {
                    "doctrine/annotations": ">=3.0",
                    "doctrine/orm": "<2.11 || >=3.0",
                    "twig/twig": "<1.34 || >=2.0 <2.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1 || ^2",
                    "doctrine/coding-standard": "^9.0",
                    "doctrine/deprecations": "^1.0",
                    "doctrine/orm": "^2.11 || ^3.0",
                    "friendsofphp/proxy-manager-lts": "^1.0",
                    "phpunit/phpunit": "^9.5.26 || ^10.0",
                    "psalm/plugin-phpunit": "^0.18.4",
                    "psalm/plugin-symfony": "^4",
                    "psr/log": "^1.1.4 || ^2.0 || ^3.0",
                    "symfony/phpunit-bridge": "^6.1",
                    "symfony/property-info": "^5.4 || ^6.0",
                    "symfony/proxy-manager-bridge": "^5.4 || ^6.0",
                    "symfony/security-bundle": "^5.4 || ^6.0",
                    "symfony/twig-bridge": "^5.4 || ^6.0",
                    "symfony/validator": "^5.4 || ^6.0",
                    "symfony/web-profiler-bundle": "^5.4 || ^6.0",
                    "symfony/yaml": "^5.4 || ^6.0",
                    "twig/twig": "^1.34 || ^2.12 || ^3.0",
                    "vimeo/psalm": "^4.30"
                },
                "suggest": {
                    "doctrine/orm": "The Doctrine ORM integration is optional in the bundle.",
                    "ext-pdo": "*",
                    "symfony/web-profiler-bundle": "To use the data collector."
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Bundle\\DoctrineBundle\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    },
                    {
                        "name": "Doctrine Project",
                        "homepage": "https://www.doctrine-project.org/"
                    }
                ],
                "description": "Symfony DoctrineBundle",
                "homepage": "https://www.doctrine-project.org",
                "keywords": [
                    "database",
                    "dbal",
                    "orm",
                    "persistence"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/DoctrineBundle/issues",
                    "source": "https://github.com/doctrine/DoctrineBundle/tree/2.10.2"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fdoctrine-bundle",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-08-06T09:31:40+00:00"
            },
            {
                "name": "doctrine/doctrine-migrations-bundle",
                "version": "3.2.4",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/DoctrineMigrationsBundle.git",
                    "reference": "94e6b0fe1a50901d52f59dbb9b4b0737718b2c1e"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/DoctrineMigrationsBundle/zipball/94e6b0fe1a50901d52f59dbb9b4b0737718b2c1e",
                    "reference": "94e6b0fe1a50901d52f59dbb9b4b0737718b2c1e",
                    "shasum": ""
                },
                "require": {
                    "doctrine/doctrine-bundle": "~1.0|~2.0",
                    "doctrine/migrations": "^3.2",
                    "php": "^7.2|^8.0",
                    "symfony/framework-bundle": "~3.4|~4.0|~5.0|~6.0"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^9",
                    "doctrine/orm": "^2.6",
                    "doctrine/persistence": "^1.3||^2.0",
                    "phpstan/phpstan": "^1.4",
                    "phpstan/phpstan-deprecation-rules": "^1",
                    "phpstan/phpstan-phpunit": "^1",
                    "phpstan/phpstan-strict-rules": "^1.1",
                    "phpunit/phpunit": "^8.5|^9.5",
                    "vimeo/psalm": "^4.22"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Bundle\\MigrationsBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Doctrine Project",
                        "homepage": "https://www.doctrine-project.org"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony DoctrineMigrationsBundle",
                "homepage": "https://www.doctrine-project.org",
                "keywords": [
                    "dbal",
                    "migrations",
                    "schema"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/DoctrineMigrationsBundle/issues",
                    "source": "https://github.com/doctrine/DoctrineMigrationsBundle/tree/3.2.4"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fdoctrine-migrations-bundle",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-02T08:19:26+00:00"
            },
            {
                "name": "doctrine/event-manager",
                "version": "2.0.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/event-manager.git",
                    "reference": "750671534e0241a7c50ea5b43f67e23eb5c96f32"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/event-manager/zipball/750671534e0241a7c50ea5b43f67e23eb5c96f32",
                    "reference": "750671534e0241a7c50ea5b43f67e23eb5c96f32",
                    "shasum": ""
                },
                "require": {
                    "php": "^8.1"
                },
                "conflict": {
                    "doctrine/common": "<2.9"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^10",
                    "phpstan/phpstan": "^1.8.8",
                    "phpunit/phpunit": "^9.5",
                    "vimeo/psalm": "^4.28"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Common\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    },
                    {
                        "name": "Marco Pivetta",
                        "email": "ocramius@gmail.com"
                    }
                ],
                "description": "The Doctrine Event Manager is a simple PHP event system that was built to be used with the various Doctrine projects.",
                "homepage": "https://www.doctrine-project.org/projects/event-manager.html",
                "keywords": [
                    "event",
                    "event dispatcher",
                    "event manager",
                    "event system",
                    "events"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/event-manager/issues",
                    "source": "https://github.com/doctrine/event-manager/tree/2.0.0"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fevent-manager",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-10-12T20:59:15+00:00"
            },
            {
                "name": "doctrine/inflector",
                "version": "2.0.8",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/inflector.git",
                    "reference": "f9301a5b2fb1216b2b08f02ba04dc45423db6bff"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/inflector/zipball/f9301a5b2fb1216b2b08f02ba04dc45423db6bff",
                    "reference": "f9301a5b2fb1216b2b08f02ba04dc45423db6bff",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2 || ^8.0"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^11.0",
                    "phpstan/phpstan": "^1.8",
                    "phpstan/phpstan-phpunit": "^1.1",
                    "phpstan/phpstan-strict-rules": "^1.3",
                    "phpunit/phpunit": "^8.5 || ^9.5",
                    "vimeo/psalm": "^4.25 || ^5.4"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Inflector\\": "lib/Doctrine/Inflector"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    }
                ],
                "description": "PHP Doctrine Inflector is a small library that can perform string manipulations with regard to upper/lowercase and singular/plural forms of words.",
                "homepage": "https://www.doctrine-project.org/projects/inflector.html",
                "keywords": [
                    "inflection",
                    "inflector",
                    "lowercase",
                    "manipulation",
                    "php",
                    "plural",
                    "singular",
                    "strings",
                    "uppercase",
                    "words"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/inflector/issues",
                    "source": "https://github.com/doctrine/inflector/tree/2.0.8"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Finflector",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-16T13:40:37+00:00"
            },
            {
                "name": "doctrine/instantiator",
                "version": "2.0.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/instantiator.git",
                    "reference": "c6222283fa3f4ac679f8b9ced9a4e23f163e80d0"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/instantiator/zipball/c6222283fa3f4ac679f8b9ced9a4e23f163e80d0",
                    "reference": "c6222283fa3f4ac679f8b9ced9a4e23f163e80d0",
                    "shasum": ""
                },
                "require": {
                    "php": "^8.1"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^11",
                    "ext-pdo": "*",
                    "ext-phar": "*",
                    "phpbench/phpbench": "^1.2",
                    "phpstan/phpstan": "^1.9.4",
                    "phpstan/phpstan-phpunit": "^1.3",
                    "phpunit/phpunit": "^9.5.27",
                    "vimeo/psalm": "^5.4"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Instantiator\\": "src/Doctrine/Instantiator/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Marco Pivetta",
                        "email": "ocramius@gmail.com",
                        "homepage": "https://ocramius.github.io/"
                    }
                ],
                "description": "A small, lightweight utility to instantiate objects in PHP without invoking their constructors",
                "homepage": "https://www.doctrine-project.org/projects/instantiator.html",
                "keywords": [
                    "constructor",
                    "instantiate"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/instantiator/issues",
                    "source": "https://github.com/doctrine/instantiator/tree/2.0.0"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Finstantiator",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-12-30T00:23:10+00:00"
            },
            {
                "name": "doctrine/lexer",
                "version": "2.1.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/lexer.git",
                    "reference": "39ab8fcf5a51ce4b85ca97c7a7d033eb12831124"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/lexer/zipball/39ab8fcf5a51ce4b85ca97c7a7d033eb12831124",
                    "reference": "39ab8fcf5a51ce4b85ca97c7a7d033eb12831124",
                    "shasum": ""
                },
                "require": {
                    "doctrine/deprecations": "^1.0",
                    "php": "^7.1 || ^8.0"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^9 || ^10",
                    "phpstan/phpstan": "^1.3",
                    "phpunit/phpunit": "^7.5 || ^8.5 || ^9.5",
                    "psalm/plugin-phpunit": "^0.18.3",
                    "vimeo/psalm": "^4.11 || ^5.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Common\\Lexer\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    }
                ],
                "description": "PHP Doctrine Lexer parser library that can be used in Top-Down, Recursive Descent Parsers.",
                "homepage": "https://www.doctrine-project.org/projects/lexer.html",
                "keywords": [
                    "annotations",
                    "docblock",
                    "lexer",
                    "parser",
                    "php"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/lexer/issues",
                    "source": "https://github.com/doctrine/lexer/tree/2.1.0"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Flexer",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-12-14T08:49:07+00:00"
            },
            {
                "name": "doctrine/migrations",
                "version": "3.6.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/migrations.git",
                    "reference": "e542ad8bcd606d7a18d0875babb8a6d963c9c059"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/migrations/zipball/e542ad8bcd606d7a18d0875babb8a6d963c9c059",
                    "reference": "e542ad8bcd606d7a18d0875babb8a6d963c9c059",
                    "shasum": ""
                },
                "require": {
                    "composer-runtime-api": "^2",
                    "doctrine/dbal": "^3.5.1",
                    "doctrine/deprecations": "^0.5.3 || ^1",
                    "doctrine/event-manager": "^1.2 || ^2.0",
                    "php": "^8.1",
                    "psr/log": "^1.1.3 || ^2 || ^3",
                    "symfony/console": "^4.4.16 || ^5.4 || ^6.0",
                    "symfony/stopwatch": "^4.4 || ^5.4 || ^6.0",
                    "symfony/var-exporter": "^6.2"
                },
                "conflict": {
                    "doctrine/orm": "<2.12"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^9",
                    "doctrine/orm": "^2.13",
                    "doctrine/persistence": "^2 || ^3",
                    "doctrine/sql-formatter": "^1.0",
                    "ext-pdo_sqlite": "*",
                    "phpstan/phpstan": "^1.5",
                    "phpstan/phpstan-deprecation-rules": "^1",
                    "phpstan/phpstan-phpunit": "^1.1",
                    "phpstan/phpstan-strict-rules": "^1.1",
                    "phpstan/phpstan-symfony": "^1.1",
                    "phpunit/phpunit": "^9.5.24",
                    "symfony/cache": "^4.4 || ^5.4 || ^6.0",
                    "symfony/process": "^4.4 || ^5.4 || ^6.0",
                    "symfony/yaml": "^4.4 || ^5.4 || ^6.0"
                },
                "suggest": {
                    "doctrine/sql-formatter": "Allows to generate formatted SQL with the diff command.",
                    "symfony/yaml": "Allows the use of yaml for migration configuration files."
                },
                "bin": [
                    "bin/doctrine-migrations"
                ],
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Migrations\\": "lib/Doctrine/Migrations"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Michael Simonson",
                        "email": "contact@mikesimonson.com"
                    }
                ],
                "description": "PHP Doctrine Migrations project offer additional functionality on top of the database abstraction layer (DBAL) for versioning your database schema and easily deploying changes to it. It is a very easy to use and a powerful tool.",
                "homepage": "https://www.doctrine-project.org/projects/migrations.html",
                "keywords": [
                    "database",
                    "dbal",
                    "migrations"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/migrations/issues",
                    "source": "https://github.com/doctrine/migrations/tree/3.6.0"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fmigrations",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-02-15T18:49:46+00:00"
            },
            {
                "name": "doctrine/orm",
                "version": "2.16.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/orm.git",
                    "reference": "597a63a86ca8c5f9d1ec2dc74fe3d1269d43434a"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/orm/zipball/597a63a86ca8c5f9d1ec2dc74fe3d1269d43434a",
                    "reference": "597a63a86ca8c5f9d1ec2dc74fe3d1269d43434a",
                    "shasum": ""
                },
                "require": {
                    "composer-runtime-api": "^2",
                    "doctrine/cache": "^1.12.1 || ^2.1.1",
                    "doctrine/collections": "^1.5 || ^2.1",
                    "doctrine/common": "^3.0.3",
                    "doctrine/dbal": "^2.13.1 || ^3.2",
                    "doctrine/deprecations": "^0.5.3 || ^1",
                    "doctrine/event-manager": "^1.2 || ^2",
                    "doctrine/inflector": "^1.4 || ^2.0",
                    "doctrine/instantiator": "^1.3 || ^2",
                    "doctrine/lexer": "^2",
                    "doctrine/persistence": "^2.4 || ^3",
                    "ext-ctype": "*",
                    "php": "^7.1 || ^8.0",
                    "psr/cache": "^1 || ^2 || ^3",
                    "symfony/console": "^4.2 || ^5.0 || ^6.0",
                    "symfony/polyfill-php72": "^1.23",
                    "symfony/polyfill-php80": "^1.16"
                },
                "conflict": {
                    "doctrine/annotations": "<1.13 || >= 3.0"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.13 || ^2",
                    "doctrine/coding-standard": "^9.0.2 || ^12.0",
                    "phpbench/phpbench": "^0.16.10 || ^1.0",
                    "phpstan/phpstan": "~1.4.10 || 1.10.28",
                    "phpunit/phpunit": "^7.5 || ^8.5 || ^9.6",
                    "psr/log": "^1 || ^2 || ^3",
                    "squizlabs/php_codesniffer": "3.7.2",
                    "symfony/cache": "^4.4 || ^5.4 || ^6.0",
                    "symfony/var-exporter": "^4.4 || ^5.4 || ^6.2",
                    "symfony/yaml": "^3.4 || ^4.0 || ^5.0 || ^6.0",
                    "vimeo/psalm": "4.30.0 || 5.14.1"
                },
                "suggest": {
                    "ext-dom": "Provides support for XSD validation for XML mapping files",
                    "symfony/cache": "Provides cache support for Setup Tool with doctrine/cache 2.0",
                    "symfony/yaml": "If you want to use YAML Metadata Mapping Driver"
                },
                "bin": [
                    "bin/doctrine"
                ],
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\ORM\\": "lib/Doctrine/ORM"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Marco Pivetta",
                        "email": "ocramius@gmail.com"
                    }
                ],
                "description": "Object-Relational-Mapper for PHP",
                "homepage": "https://www.doctrine-project.org/projects/orm.html",
                "keywords": [
                    "database",
                    "orm"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/orm/issues",
                    "source": "https://github.com/doctrine/orm/tree/2.16.1"
                },
                "time": "2023-08-09T13:05:08+00:00"
            },
            {
                "name": "doctrine/persistence",
                "version": "3.2.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/persistence.git",
                    "reference": "63fee8c33bef740db6730eb2a750cd3da6495603"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/persistence/zipball/63fee8c33bef740db6730eb2a750cd3da6495603",
                    "reference": "63fee8c33bef740db6730eb2a750cd3da6495603",
                    "shasum": ""
                },
                "require": {
                    "doctrine/event-manager": "^1 || ^2",
                    "php": "^7.2 || ^8.0",
                    "psr/cache": "^1.0 || ^2.0 || ^3.0"
                },
                "conflict": {
                    "doctrine/common": "<2.10"
                },
                "require-dev": {
                    "composer/package-versions-deprecated": "^1.11",
                    "doctrine/coding-standard": "^11",
                    "doctrine/common": "^3.0",
                    "phpstan/phpstan": "1.9.4",
                    "phpstan/phpstan-phpunit": "^1",
                    "phpstan/phpstan-strict-rules": "^1.1",
                    "phpunit/phpunit": "^8.5 || ^9.5",
                    "symfony/cache": "^4.4 || ^5.4 || ^6.0",
                    "vimeo/psalm": "4.30.0 || 5.3.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Persistence\\": "src/Persistence"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Guilherme Blanco",
                        "email": "guilhermeblanco@gmail.com"
                    },
                    {
                        "name": "Roman Borschel",
                        "email": "roman@code-factory.org"
                    },
                    {
                        "name": "Benjamin Eberlei",
                        "email": "kontakt@beberlei.de"
                    },
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    },
                    {
                        "name": "Johannes Schmitt",
                        "email": "schmittjoh@gmail.com"
                    },
                    {
                        "name": "Marco Pivetta",
                        "email": "ocramius@gmail.com"
                    }
                ],
                "description": "The Doctrine Persistence project is a set of shared interfaces and functionality that the different Doctrine object mappers share.",
                "homepage": "https://www.doctrine-project.org/projects/persistence.html",
                "keywords": [
                    "mapper",
                    "object",
                    "odm",
                    "orm",
                    "persistence"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/persistence/issues",
                    "source": "https://github.com/doctrine/persistence/tree/3.2.0"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fpersistence",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-17T18:32:04+00:00"
            },
            {
                "name": "doctrine/sql-formatter",
                "version": "1.1.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/sql-formatter.git",
                    "reference": "25a06c7bf4c6b8218f47928654252863ffc890a5"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/sql-formatter/zipball/25a06c7bf4c6b8218f47928654252863ffc890a5",
                    "reference": "25a06c7bf4c6b8218f47928654252863ffc890a5",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.1 || ^8.0"
                },
                "require-dev": {
                    "bamarni/composer-bin-plugin": "^1.4"
                },
                "bin": [
                    "bin/sql-formatter"
                ],
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\SqlFormatter\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Jeremy Dorn",
                        "email": "jeremy@jeremydorn.com",
                        "homepage": "https://jeremydorn.com/"
                    }
                ],
                "description": "a PHP SQL highlighting library",
                "homepage": "https://github.com/doctrine/sql-formatter/",
                "keywords": [
                    "highlight",
                    "sql"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/sql-formatter/issues",
                    "source": "https://github.com/doctrine/sql-formatter/tree/1.1.3"
                },
                "time": "2022-05-23T21:33:49+00:00"
            },
            {
                "name": "egulias/email-validator",
                "version": "4.0.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/egulias/EmailValidator.git",
                    "reference": "3a85486b709bc384dae8eb78fb2eec649bdb64ff"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/egulias/EmailValidator/zipball/3a85486b709bc384dae8eb78fb2eec649bdb64ff",
                    "reference": "3a85486b709bc384dae8eb78fb2eec649bdb64ff",
                    "shasum": ""
                },
                "require": {
                    "doctrine/lexer": "^2.0 || ^3.0",
                    "php": ">=8.1",
                    "symfony/polyfill-intl-idn": "^1.26"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.5.27",
                    "vimeo/psalm": "^4.30"
                },
                "suggest": {
                    "ext-intl": "PHP Internationalization Libraries are required to use the SpoofChecking validation"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "4.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Egulias\\EmailValidator\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Eduardo Gulias Davis"
                    }
                ],
                "description": "A library for validating emails against several RFCs",
                "homepage": "https://github.com/egulias/EmailValidator",
                "keywords": [
                    "email",
                    "emailvalidation",
                    "emailvalidator",
                    "validation",
                    "validator"
                ],
                "support": {
                    "issues": "https://github.com/egulias/EmailValidator/issues",
                    "source": "https://github.com/egulias/EmailValidator/tree/4.0.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/egulias",
                        "type": "github"
                    }
                ],
                "time": "2023-01-14T14:17:03+00:00"
            },
            {
                "name": "fakerphp/faker",
                "version": "v1.23.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/FakerPHP/Faker.git",
                    "reference": "e3daa170d00fde61ea7719ef47bb09bb8f1d9b01"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/FakerPHP/Faker/zipball/e3daa170d00fde61ea7719ef47bb09bb8f1d9b01",
                    "reference": "e3daa170d00fde61ea7719ef47bb09bb8f1d9b01",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.4 || ^8.0",
                    "psr/container": "^1.0 || ^2.0",
                    "symfony/deprecation-contracts": "^2.2 || ^3.0"
                },
                "conflict": {
                    "fzaninotto/faker": "*"
                },
                "require-dev": {
                    "bamarni/composer-bin-plugin": "^1.4.1",
                    "doctrine/persistence": "^1.3 || ^2.0",
                    "ext-intl": "*",
                    "phpunit/phpunit": "^9.5.26",
                    "symfony/phpunit-bridge": "^5.4.16"
                },
                "suggest": {
                    "doctrine/orm": "Required to use Faker\\ORM\\Doctrine",
                    "ext-curl": "Required by Faker\\Provider\\Image to download images.",
                    "ext-dom": "Required by Faker\\Provider\\HtmlLorem for generating random HTML.",
                    "ext-iconv": "Required by Faker\\Provider\\ru_RU\\Text::realText() for generating real Russian text.",
                    "ext-mbstring": "Required for multibyte Unicode string functionality."
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "v1.21-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Faker\\": "src/Faker/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "François Zaninotto"
                    }
                ],
                "description": "Faker is a PHP library that generates fake data for you.",
                "keywords": [
                    "data",
                    "faker",
                    "fixtures"
                ],
                "support": {
                    "issues": "https://github.com/FakerPHP/Faker/issues",
                    "source": "https://github.com/FakerPHP/Faker/tree/v1.23.0"
                },
                "time": "2023-06-12T08:44:38+00:00"
            },
            {
                "name": "gedmo/doctrine-extensions",
                "version": "v3.12.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine-extensions/DoctrineExtensions.git",
                    "reference": "eef4b4978118fdb4c0a03509325e807ad96e3bec"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine-extensions/DoctrineExtensions/zipball/eef4b4978118fdb4c0a03509325e807ad96e3bec",
                    "reference": "eef4b4978118fdb4c0a03509325e807ad96e3bec",
                    "shasum": ""
                },
                "require": {
                    "behat/transliterator": "~1.2",
                    "doctrine/annotations": "^1.13 || ^2.0",
                    "doctrine/collections": "^1.2 || ^2.0",
                    "doctrine/common": "^2.13 || ^3.0",
                    "doctrine/event-manager": "^1.2 || ^2.0",
                    "doctrine/persistence": "^2.2 || ^3.0",
                    "php": "^7.2 || ^8.0",
                    "psr/cache": "^1 || ^2 || ^3",
                    "symfony/cache": "^4.4 || ^5.3 || ^6.0",
                    "symfony/deprecation-contracts": "^2.1 || ^3.0"
                },
                "conflict": {
                    "doctrine/dbal": "<2.13.1 || ^3.0 <3.2",
                    "doctrine/mongodb-odm": "<2.3",
                    "doctrine/orm": "<2.10.2",
                    "sebastian/comparator": "<2.0"
                },
                "require-dev": {
                    "doctrine/cache": "^1.11 || ^2.0",
                    "doctrine/dbal": "^2.13.1 || ^3.2",
                    "doctrine/doctrine-bundle": "^2.3",
                    "doctrine/mongodb-odm": "^2.3",
                    "doctrine/orm": "^2.10.2",
                    "friendsofphp/php-cs-fixer": "^3.4.0 <3.10",
                    "nesbot/carbon": "^2.55",
                    "phpstan/phpstan": "^1.10.2",
                    "phpstan/phpstan-doctrine": "^1.0",
                    "phpstan/phpstan-phpunit": "^1.0",
                    "phpunit/phpunit": "^8.5 || ^9.5",
                    "rector/rector": "^0.15.20",
                    "symfony/console": "^4.4 || ^5.3 || ^6.0",
                    "symfony/phpunit-bridge": "^6.0",
                    "symfony/yaml": "^4.4 || ^5.3 || ^6.0"
                },
                "suggest": {
                    "doctrine/mongodb-odm": "to use the extensions with the MongoDB ODM",
                    "doctrine/orm": "to use the extensions with the ORM"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.13-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Gedmo\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Gediminas Morkevicius",
                        "email": "gediminas.morkevicius@gmail.com"
                    },
                    {
                        "name": "Gustavo Falco",
                        "email": "comfortablynumb84@gmail.com"
                    },
                    {
                        "name": "David Buchmann",
                        "email": "david@liip.ch"
                    }
                ],
                "description": "Doctrine behavioral extensions",
                "homepage": "http://gediminasm.org/",
                "keywords": [
                    "Blameable",
                    "behaviors",
                    "doctrine",
                    "extensions",
                    "gedmo",
                    "loggable",
                    "nestedset",
                    "odm",
                    "orm",
                    "sluggable",
                    "sortable",
                    "timestampable",
                    "translatable",
                    "tree",
                    "uploadable"
                ],
                "support": {
                    "email": "gediminas.morkevicius@gmail.com",
                    "issues": "https://github.com/doctrine-extensions/DoctrineExtensions/issues",
                    "source": "https://github.com/doctrine-extensions/DoctrineExtensions/tree/v3.12.0",
                    "wiki": "https://github.com/Atlantic18/DoctrineExtensions/tree/main/doc"
                },
                "funding": [
                    {
                        "url": "https://github.com/l3pp4rd",
                        "type": "github"
                    },
                    {
                        "url": "https://github.com/mbabker",
                        "type": "github"
                    },
                    {
                        "url": "https://github.com/phansys",
                        "type": "github"
                    },
                    {
                        "url": "https://github.com/stof",
                        "type": "github"
                    }
                ],
                "time": "2023-07-08T20:38:42+00:00"
            },
            {
                "name": "guzzlehttp/guzzle",
                "version": "7.7.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/guzzle/guzzle.git",
                    "reference": "fb7566caccf22d74d1ab270de3551f72a58399f5"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/guzzle/guzzle/zipball/fb7566caccf22d74d1ab270de3551f72a58399f5",
                    "reference": "fb7566caccf22d74d1ab270de3551f72a58399f5",
                    "shasum": ""
                },
                "require": {
                    "ext-json": "*",
                    "guzzlehttp/promises": "^1.5.3 || ^2.0",
                    "guzzlehttp/psr7": "^1.9.1 || ^2.4.5",
                    "php": "^7.2.5 || ^8.0",
                    "psr/http-client": "^1.0",
                    "symfony/deprecation-contracts": "^2.2 || ^3.0"
                },
                "provide": {
                    "psr/http-client-implementation": "1.0"
                },
                "require-dev": {
                    "bamarni/composer-bin-plugin": "^1.8.1",
                    "ext-curl": "*",
                    "php-http/client-integration-tests": "dev-master#2c025848417c1135031fdf9c728ee53d0a7ceaee as 3.0.999",
                    "php-http/message-factory": "^1.1",
                    "phpunit/phpunit": "^8.5.29 || ^9.5.23",
                    "psr/log": "^1.1 || ^2.0 || ^3.0"
                },
                "suggest": {
                    "ext-curl": "Required for CURL handler support",
                    "ext-intl": "Required for Internationalized Domain Name (IDN) support",
                    "psr/log": "Required for using the Log middleware"
                },
                "type": "library",
                "extra": {
                    "bamarni-bin": {
                        "bin-links": true,
                        "forward-command": false
                    }
                },
                "autoload": {
                    "files": [
                        "src/functions_include.php"
                    ],
                    "psr-4": {
                        "GuzzleHttp\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Graham Campbell",
                        "email": "hello@gjcampbell.co.uk",
                        "homepage": "https://github.com/GrahamCampbell"
                    },
                    {
                        "name": "Michael Dowling",
                        "email": "mtdowling@gmail.com",
                        "homepage": "https://github.com/mtdowling"
                    },
                    {
                        "name": "Jeremy Lindblom",
                        "email": "jeremeamia@gmail.com",
                        "homepage": "https://github.com/jeremeamia"
                    },
                    {
                        "name": "George Mponos",
                        "email": "gmponos@gmail.com",
                        "homepage": "https://github.com/gmponos"
                    },
                    {
                        "name": "Tobias Nyholm",
                        "email": "tobias.nyholm@gmail.com",
                        "homepage": "https://github.com/Nyholm"
                    },
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com",
                        "homepage": "https://github.com/sagikazarmark"
                    },
                    {
                        "name": "Tobias Schultze",
                        "email": "webmaster@tubo-world.de",
                        "homepage": "https://github.com/Tobion"
                    }
                ],
                "description": "Guzzle is a PHP HTTP client library",
                "keywords": [
                    "client",
                    "curl",
                    "framework",
                    "http",
                    "http client",
                    "psr-18",
                    "psr-7",
                    "rest",
                    "web service"
                ],
                "support": {
                    "issues": "https://github.com/guzzle/guzzle/issues",
                    "source": "https://github.com/guzzle/guzzle/tree/7.7.0"
                },
                "funding": [
                    {
                        "url": "https://github.com/GrahamCampbell",
                        "type": "github"
                    },
                    {
                        "url": "https://github.com/Nyholm",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/guzzlehttp/guzzle",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-21T14:04:53+00:00"
            },
            {
                "name": "guzzlehttp/promises",
                "version": "2.0.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/guzzle/promises.git",
                    "reference": "111166291a0f8130081195ac4556a5587d7f1b5d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/guzzle/promises/zipball/111166291a0f8130081195ac4556a5587d7f1b5d",
                    "reference": "111166291a0f8130081195ac4556a5587d7f1b5d",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2.5 || ^8.0"
                },
                "require-dev": {
                    "bamarni/composer-bin-plugin": "^1.8.1",
                    "phpunit/phpunit": "^8.5.29 || ^9.5.23"
                },
                "type": "library",
                "extra": {
                    "bamarni-bin": {
                        "bin-links": true,
                        "forward-command": false
                    }
                },
                "autoload": {
                    "psr-4": {
                        "GuzzleHttp\\Promise\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Graham Campbell",
                        "email": "hello@gjcampbell.co.uk",
                        "homepage": "https://github.com/GrahamCampbell"
                    },
                    {
                        "name": "Michael Dowling",
                        "email": "mtdowling@gmail.com",
                        "homepage": "https://github.com/mtdowling"
                    },
                    {
                        "name": "Tobias Nyholm",
                        "email": "tobias.nyholm@gmail.com",
                        "homepage": "https://github.com/Nyholm"
                    },
                    {
                        "name": "Tobias Schultze",
                        "email": "webmaster@tubo-world.de",
                        "homepage": "https://github.com/Tobion"
                    }
                ],
                "description": "Guzzle promises library",
                "keywords": [
                    "promise"
                ],
                "support": {
                    "issues": "https://github.com/guzzle/promises/issues",
                    "source": "https://github.com/guzzle/promises/tree/2.0.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/GrahamCampbell",
                        "type": "github"
                    },
                    {
                        "url": "https://github.com/Nyholm",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/guzzlehttp/promises",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-08-03T15:11:55+00:00"
            },
            {
                "name": "guzzlehttp/psr7",
                "version": "2.6.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/guzzle/psr7.git",
                    "reference": "8bd7c33a0734ae1c5d074360512beb716bef3f77"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/guzzle/psr7/zipball/8bd7c33a0734ae1c5d074360512beb716bef3f77",
                    "reference": "8bd7c33a0734ae1c5d074360512beb716bef3f77",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2.5 || ^8.0",
                    "psr/http-factory": "^1.0",
                    "psr/http-message": "^1.1 || ^2.0",
                    "ralouphie/getallheaders": "^3.0"
                },
                "provide": {
                    "psr/http-factory-implementation": "1.0",
                    "psr/http-message-implementation": "1.0"
                },
                "require-dev": {
                    "bamarni/composer-bin-plugin": "^1.8.1",
                    "http-interop/http-factory-tests": "^0.9",
                    "phpunit/phpunit": "^8.5.29 || ^9.5.23"
                },
                "suggest": {
                    "laminas/laminas-httphandlerrunner": "Emit PSR-7 responses"
                },
                "type": "library",
                "extra": {
                    "bamarni-bin": {
                        "bin-links": true,
                        "forward-command": false
                    }
                },
                "autoload": {
                    "psr-4": {
                        "GuzzleHttp\\Psr7\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Graham Campbell",
                        "email": "hello@gjcampbell.co.uk",
                        "homepage": "https://github.com/GrahamCampbell"
                    },
                    {
                        "name": "Michael Dowling",
                        "email": "mtdowling@gmail.com",
                        "homepage": "https://github.com/mtdowling"
                    },
                    {
                        "name": "George Mponos",
                        "email": "gmponos@gmail.com",
                        "homepage": "https://github.com/gmponos"
                    },
                    {
                        "name": "Tobias Nyholm",
                        "email": "tobias.nyholm@gmail.com",
                        "homepage": "https://github.com/Nyholm"
                    },
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com",
                        "homepage": "https://github.com/sagikazarmark"
                    },
                    {
                        "name": "Tobias Schultze",
                        "email": "webmaster@tubo-world.de",
                        "homepage": "https://github.com/Tobion"
                    },
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com",
                        "homepage": "https://sagikazarmark.hu"
                    }
                ],
                "description": "PSR-7 message implementation that also provides common utility methods",
                "keywords": [
                    "http",
                    "message",
                    "psr-7",
                    "request",
                    "response",
                    "stream",
                    "uri",
                    "url"
                ],
                "support": {
                    "issues": "https://github.com/guzzle/psr7/issues",
                    "source": "https://github.com/guzzle/psr7/tree/2.6.0"
                },
                "funding": [
                    {
                        "url": "https://github.com/GrahamCampbell",
                        "type": "github"
                    },
                    {
                        "url": "https://github.com/Nyholm",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/guzzlehttp/psr7",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-08-03T15:06:02+00:00"
            },
            {
                "name": "league/omnipay",
                "version": "v3.2.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/thephpleague/omnipay.git",
                    "reference": "38f66a0cc043ed51d6edf7956d6439a2f263501f"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/thephpleague/omnipay/zipball/38f66a0cc043ed51d6edf7956d6439a2f263501f",
                    "reference": "38f66a0cc043ed51d6edf7956d6439a2f263501f",
                    "shasum": ""
                },
                "require": {
                    "omnipay/common": "^3.1",
                    "php": "^7.2|^8.0",
                    "php-http/discovery": "^1.14",
                    "php-http/guzzle7-adapter": "^1"
                },
                "require-dev": {
                    "omnipay/tests": "^3|^4"
                },
                "type": "metapackage",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.2.x-dev"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Adrian Macneil",
                        "email": "adrian@adrianmacneil.com"
                    },
                    {
                        "name": "Barry vd. Heuvel",
                        "email": "barryvdh@gmail.com"
                    }
                ],
                "description": "Omnipay payment processing library",
                "homepage": "https://omnipay.thephpleague.com/",
                "keywords": [
                    "checkout",
                    "creditcard",
                    "omnipay",
                    "payment"
                ],
                "support": {
                    "issues": "https://github.com/thephpleague/omnipay/issues",
                    "source": "https://github.com/thephpleague/omnipay/tree/v3.2.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/barryvdh",
                        "type": "github"
                    }
                ],
                "time": "2021-06-05T11:34:12+00:00"
            },
            {
                "name": "masterminds/html5",
                "version": "2.8.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/Masterminds/html5-php.git",
                    "reference": "f47dcf3c70c584de14f21143c55d9939631bc6cf"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/Masterminds/html5-php/zipball/f47dcf3c70c584de14f21143c55d9939631bc6cf",
                    "reference": "f47dcf3c70c584de14f21143c55d9939631bc6cf",
                    "shasum": ""
                },
                "require": {
                    "ext-dom": "*",
                    "php": ">=5.3.0"
                },
                "require-dev": {
                    "phpunit/phpunit": "^4.8.35 || ^5.7.21 || ^6 || ^7 || ^8"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.7-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Masterminds\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Matt Butcher",
                        "email": "technosophos@gmail.com"
                    },
                    {
                        "name": "Matt Farina",
                        "email": "matt@mattfarina.com"
                    },
                    {
                        "name": "Asmir Mustafic",
                        "email": "goetas@gmail.com"
                    }
                ],
                "description": "An HTML5 parser and serializer.",
                "homepage": "http://masterminds.github.io/html5-php",
                "keywords": [
                    "HTML5",
                    "dom",
                    "html",
                    "parser",
                    "querypath",
                    "serializer",
                    "xml"
                ],
                "support": {
                    "issues": "https://github.com/Masterminds/html5-php/issues",
                    "source": "https://github.com/Masterminds/html5-php/tree/2.8.1"
                },
                "time": "2023-05-10T11:58:31+00:00"
            },
            {
                "name": "moneyphp/money",
                "version": "v4.1.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/moneyphp/money.git",
                    "reference": "9682220995ffd396843be5b4ee1e5f2c2d6ecee2"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/moneyphp/money/zipball/9682220995ffd396843be5b4ee1e5f2c2d6ecee2",
                    "reference": "9682220995ffd396843be5b4ee1e5f2c2d6ecee2",
                    "shasum": ""
                },
                "require": {
                    "ext-bcmath": "*",
                    "ext-filter": "*",
                    "ext-json": "*",
                    "php": "~8.0.0 || ~8.1.0 || ~8.2.0"
                },
                "require-dev": {
                    "cache/taggable-cache": "^1.1.0",
                    "doctrine/coding-standard": "^9.0",
                    "doctrine/instantiator": "^1.4.0",
                    "ext-gmp": "*",
                    "ext-intl": "*",
                    "florianv/exchanger": "^2.6.3",
                    "florianv/swap": "^4.3.0",
                    "moneyphp/crypto-currencies": "^1.0.0",
                    "moneyphp/iso-currencies": "^3.2.1",
                    "php-http/message": "^1.11.0",
                    "php-http/mock-client": "^1.4.1",
                    "phpbench/phpbench": "^1.2.5",
                    "phpspec/phpspec": "^7.3",
                    "phpunit/phpunit": "^9.5.4",
                    "psalm/plugin-phpunit": "^0.18.4",
                    "psr/cache": "^1.0.1",
                    "vimeo/psalm": "~5.3.0"
                },
                "suggest": {
                    "ext-gmp": "Calculate without integer limits",
                    "ext-intl": "Format Money objects with intl",
                    "florianv/exchanger": "Exchange rates library for PHP",
                    "florianv/swap": "Exchange rates library for PHP",
                    "psr/cache-implementation": "Used for Currency caching"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Money\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Mathias Verraes",
                        "email": "mathias@verraes.net",
                        "homepage": "http://verraes.net"
                    },
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com"
                    },
                    {
                        "name": "Frederik Bosch",
                        "email": "f.bosch@genkgo.nl"
                    }
                ],
                "description": "PHP implementation of Fowler's Money pattern",
                "homepage": "http://moneyphp.org",
                "keywords": [
                    "Value Object",
                    "money",
                    "vo"
                ],
                "support": {
                    "issues": "https://github.com/moneyphp/money/issues",
                    "source": "https://github.com/moneyphp/money/tree/v4.1.1"
                },
                "time": "2023-04-11T09:18:34+00:00"
            },
            {
                "name": "monolog/monolog",
                "version": "3.4.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/Seldaek/monolog.git",
                    "reference": "e2392369686d420ca32df3803de28b5d6f76867d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/Seldaek/monolog/zipball/e2392369686d420ca32df3803de28b5d6f76867d",
                    "reference": "e2392369686d420ca32df3803de28b5d6f76867d",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/log": "^2.0 || ^3.0"
                },
                "provide": {
                    "psr/log-implementation": "3.0.0"
                },
                "require-dev": {
                    "aws/aws-sdk-php": "^3.0",
                    "doctrine/couchdb": "~1.0@dev",
                    "elasticsearch/elasticsearch": "^7 || ^8",
                    "ext-json": "*",
                    "graylog2/gelf-php": "^1.4.2 || ^2.0",
                    "guzzlehttp/guzzle": "^7.4.5",
                    "guzzlehttp/psr7": "^2.2",
                    "mongodb/mongodb": "^1.8",
                    "php-amqplib/php-amqplib": "~2.4 || ^3",
                    "phpstan/phpstan": "^1.9",
                    "phpstan/phpstan-deprecation-rules": "^1.0",
                    "phpstan/phpstan-strict-rules": "^1.4",
                    "phpunit/phpunit": "^10.1",
                    "predis/predis": "^1.1 || ^2",
                    "ruflin/elastica": "^7",
                    "symfony/mailer": "^5.4 || ^6",
                    "symfony/mime": "^5.4 || ^6"
                },
                "suggest": {
                    "aws/aws-sdk-php": "Allow sending log messages to AWS services like DynamoDB",
                    "doctrine/couchdb": "Allow sending log messages to a CouchDB server",
                    "elasticsearch/elasticsearch": "Allow sending log messages to an Elasticsearch server via official client",
                    "ext-amqp": "Allow sending log messages to an AMQP server (1.0+ required)",
                    "ext-curl": "Required to send log messages using the IFTTTHandler, the LogglyHandler, the SendGridHandler, the SlackWebhookHandler or the TelegramBotHandler",
                    "ext-mbstring": "Allow to work properly with unicode symbols",
                    "ext-mongodb": "Allow sending log messages to a MongoDB server (via driver)",
                    "ext-openssl": "Required to send log messages using SSL",
                    "ext-sockets": "Allow sending log messages to a Syslog server (via UDP driver)",
                    "graylog2/gelf-php": "Allow sending log messages to a GrayLog2 server",
                    "mongodb/mongodb": "Allow sending log messages to a MongoDB server (via library)",
                    "php-amqplib/php-amqplib": "Allow sending log messages to an AMQP server using php-amqplib",
                    "rollbar/rollbar": "Allow sending log messages to Rollbar",
                    "ruflin/elastica": "Allow sending log messages to an Elastic Search server"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Monolog\\": "src/Monolog"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Jordi Boggiano",
                        "email": "j.boggiano@seld.be",
                        "homepage": "https://seld.be"
                    }
                ],
                "description": "Sends your logs to files, sockets, inboxes, databases and various web services",
                "homepage": "https://github.com/Seldaek/monolog",
                "keywords": [
                    "log",
                    "logging",
                    "psr-3"
                ],
                "support": {
                    "issues": "https://github.com/Seldaek/monolog/issues",
                    "source": "https://github.com/Seldaek/monolog/tree/3.4.0"
                },
                "funding": [
                    {
                        "url": "https://github.com/Seldaek",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/monolog/monolog",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-21T08:46:11+00:00"
            },
            {
                "name": "nelmio/cors-bundle",
                "version": "2.3.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/nelmio/NelmioCorsBundle.git",
                    "reference": "185d2c0ae50a3f0b628790170164d5f1c5b7c281"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/nelmio/NelmioCorsBundle/zipball/185d2c0ae50a3f0b628790170164d5f1c5b7c281",
                    "reference": "185d2c0ae50a3f0b628790170164d5f1c5b7c281",
                    "shasum": ""
                },
                "require": {
                    "psr/log": "^1.0 || ^2.0 || ^3.0",
                    "symfony/framework-bundle": "^4.4 || ^5.4 || ^6.0"
                },
                "require-dev": {
                    "mockery/mockery": "^1.2",
                    "symfony/phpunit-bridge": "^4.4 || ^5.4 || ^6.0"
                },
                "type": "symfony-bundle",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Nelmio\\CorsBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nelmio",
                        "homepage": "http://nelm.io"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://github.com/nelmio/NelmioCorsBundle/contributors"
                    }
                ],
                "description": "Adds CORS (Cross-Origin Resource Sharing) headers support in your Symfony application",
                "keywords": [
                    "api",
                    "cors",
                    "crossdomain"
                ],
                "support": {
                    "issues": "https://github.com/nelmio/NelmioCorsBundle/issues",
                    "source": "https://github.com/nelmio/NelmioCorsBundle/tree/2.3.1"
                },
                "time": "2023-02-16T08:49:29+00:00"
            },
            {
                "name": "omnipay/common",
                "version": "v3.2.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/thephpleague/omnipay-common.git",
                    "reference": "80545e9f4faab0efad36cc5f1e11a184dda22baf"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/thephpleague/omnipay-common/zipball/80545e9f4faab0efad36cc5f1e11a184dda22baf",
                    "reference": "80545e9f4faab0efad36cc5f1e11a184dda22baf",
                    "shasum": ""
                },
                "require": {
                    "moneyphp/money": "^3.1|^4.0.3",
                    "php": "^7.2|^8",
                    "php-http/client-implementation": "^1",
                    "php-http/discovery": "^1.14",
                    "php-http/message": "^1.5",
                    "php-http/message-factory": "^1.1",
                    "symfony/http-foundation": "^2.1|^3|^4|^5|^6"
                },
                "require-dev": {
                    "omnipay/tests": "^4.1",
                    "php-http/guzzle7-adapter": "^1",
                    "php-http/mock-client": "^1",
                    "squizlabs/php_codesniffer": "^3.5"
                },
                "suggest": {
                    "league/omnipay": "The default Omnipay package provides a default HTTP Adapter."
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.1.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Omnipay\\Common\\": "src/Common"
                    },
                    "classmap": [
                        "src/Omnipay.php"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Adrian Macneil",
                        "email": "adrian@adrianmacneil.com"
                    },
                    {
                        "name": "Barry vd. Heuvel",
                        "email": "barryvdh@gmail.com"
                    },
                    {
                        "name": "Jason Judge",
                        "email": "jason.judge@consil.co.uk"
                    },
                    {
                        "name": "Del"
                    },
                    {
                        "name": "Omnipay Contributors",
                        "homepage": "https://github.com/thephpleague/omnipay-common/contributors"
                    }
                ],
                "description": "Common components for Omnipay payment processing library",
                "homepage": "https://github.com/thephpleague/omnipay-common",
                "keywords": [
                    "gateway",
                    "merchant",
                    "omnipay",
                    "pay",
                    "payment",
                    "purchase"
                ],
                "support": {
                    "issues": "https://github.com/thephpleague/omnipay-common/issues",
                    "source": "https://github.com/thephpleague/omnipay-common/tree/v3.2.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/barryvdh",
                        "type": "github"
                    }
                ],
                "time": "2023-05-30T12:44:03+00:00"
            },
            {
                "name": "omnipay/paypal",
                "version": "v3.0.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/thephpleague/omnipay-paypal.git",
                    "reference": "519db61b32ff0c1e56cbec94762b970ee9674f65"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/thephpleague/omnipay-paypal/zipball/519db61b32ff0c1e56cbec94762b970ee9674f65",
                    "reference": "519db61b32ff0c1e56cbec94762b970ee9674f65",
                    "shasum": ""
                },
                "require": {
                    "omnipay/common": "^3"
                },
                "require-dev": {
                    "omnipay/tests": "^3",
                    "phpro/grumphp": "^0.14",
                    "squizlabs/php_codesniffer": "^3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Omnipay\\PayPal\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Adrian Macneil",
                        "email": "adrian@adrianmacneil.com"
                    },
                    {
                        "name": "Omnipay Contributors",
                        "homepage": "https://github.com/thephpleague/omnipay-paypal/contributors"
                    }
                ],
                "description": "PayPal gateway for Omnipay payment processing library",
                "homepage": "https://github.com/thephpleague/omnipay-paypal",
                "keywords": [
                    "gateway",
                    "merchant",
                    "omnipay",
                    "pay",
                    "payment",
                    "paypal",
                    "purchase"
                ],
                "support": {
                    "issues": "https://github.com/thephpleague/omnipay-paypal/issues",
                    "source": "https://github.com/thephpleague/omnipay-paypal/tree/v3.0.2"
                },
                "time": "2018-05-15T10:35:58+00:00"
            },
            {
                "name": "php-http/discovery",
                "version": "1.19.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-http/discovery.git",
                    "reference": "57f3de01d32085fea20865f9b16fb0e69347c39e"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-http/discovery/zipball/57f3de01d32085fea20865f9b16fb0e69347c39e",
                    "reference": "57f3de01d32085fea20865f9b16fb0e69347c39e",
                    "shasum": ""
                },
                "require": {
                    "composer-plugin-api": "^1.0|^2.0",
                    "php": "^7.1 || ^8.0"
                },
                "conflict": {
                    "nyholm/psr7": "<1.0",
                    "zendframework/zend-diactoros": "*"
                },
                "provide": {
                    "php-http/async-client-implementation": "*",
                    "php-http/client-implementation": "*",
                    "psr/http-client-implementation": "*",
                    "psr/http-factory-implementation": "*",
                    "psr/http-message-implementation": "*"
                },
                "require-dev": {
                    "composer/composer": "^1.0.2|^2.0",
                    "graham-campbell/phpspec-skip-example-extension": "^5.0",
                    "php-http/httplug": "^1.0 || ^2.0",
                    "php-http/message-factory": "^1.0",
                    "phpspec/phpspec": "^5.1 || ^6.1 || ^7.3",
                    "symfony/phpunit-bridge": "^6.2"
                },
                "type": "composer-plugin",
                "extra": {
                    "class": "Http\\Discovery\\Composer\\Plugin",
                    "plugin-optional": true
                },
                "autoload": {
                    "psr-4": {
                        "Http\\Discovery\\": "src/"
                    },
                    "exclude-from-classmap": [
                        "src/Composer/Plugin.php"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com"
                    }
                ],
                "description": "Finds and installs PSR-7, PSR-17, PSR-18 and HTTPlug implementations",
                "homepage": "http://php-http.org",
                "keywords": [
                    "adapter",
                    "client",
                    "discovery",
                    "factory",
                    "http",
                    "message",
                    "psr17",
                    "psr7"
                ],
                "support": {
                    "issues": "https://github.com/php-http/discovery/issues",
                    "source": "https://github.com/php-http/discovery/tree/1.19.1"
                },
                "time": "2023-07-11T07:02:26+00:00"
            },
            {
                "name": "php-http/guzzle7-adapter",
                "version": "1.0.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-http/guzzle7-adapter.git",
                    "reference": "fb075a71dbfa4847cf0c2938c4e5a9c478ef8b01"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-http/guzzle7-adapter/zipball/fb075a71dbfa4847cf0c2938c4e5a9c478ef8b01",
                    "reference": "fb075a71dbfa4847cf0c2938c4e5a9c478ef8b01",
                    "shasum": ""
                },
                "require": {
                    "guzzlehttp/guzzle": "^7.0",
                    "php": "^7.2 | ^8.0",
                    "php-http/httplug": "^2.0",
                    "psr/http-client": "^1.0"
                },
                "provide": {
                    "php-http/async-client-implementation": "1.0",
                    "php-http/client-implementation": "1.0",
                    "psr/http-client-implementation": "1.0"
                },
                "require-dev": {
                    "php-http/client-integration-tests": "^3.0",
                    "phpunit/phpunit": "^8.0|^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "0.2.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Http\\Adapter\\Guzzle7\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Tobias Nyholm",
                        "email": "tobias.nyholm@gmail.com"
                    }
                ],
                "description": "Guzzle 7 HTTP Adapter",
                "homepage": "http://httplug.io",
                "keywords": [
                    "Guzzle",
                    "http"
                ],
                "support": {
                    "issues": "https://github.com/php-http/guzzle7-adapter/issues",
                    "source": "https://github.com/php-http/guzzle7-adapter/tree/1.0.0"
                },
                "time": "2021-03-09T07:35:15+00:00"
            },
            {
                "name": "php-http/httplug",
                "version": "2.4.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-http/httplug.git",
                    "reference": "625ad742c360c8ac580fcc647a1541d29e257f67"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-http/httplug/zipball/625ad742c360c8ac580fcc647a1541d29e257f67",
                    "reference": "625ad742c360c8ac580fcc647a1541d29e257f67",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.1 || ^8.0",
                    "php-http/promise": "^1.1",
                    "psr/http-client": "^1.0",
                    "psr/http-message": "^1.0 || ^2.0"
                },
                "require-dev": {
                    "friends-of-phpspec/phpspec-code-coverage": "^4.1 || ^5.0 || ^6.0",
                    "phpspec/phpspec": "^5.1 || ^6.0 || ^7.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Http\\Client\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Eric GELOEN",
                        "email": "geloen.eric@gmail.com"
                    },
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com",
                        "homepage": "https://sagikazarmark.hu"
                    }
                ],
                "description": "HTTPlug, the HTTP client abstraction for PHP",
                "homepage": "http://httplug.io",
                "keywords": [
                    "client",
                    "http"
                ],
                "support": {
                    "issues": "https://github.com/php-http/httplug/issues",
                    "source": "https://github.com/php-http/httplug/tree/2.4.0"
                },
                "time": "2023-04-14T15:10:03+00:00"
            },
            {
                "name": "php-http/message",
                "version": "1.16.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-http/message.git",
                    "reference": "47a14338bf4ebd67d317bf1144253d7db4ab55fd"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-http/message/zipball/47a14338bf4ebd67d317bf1144253d7db4ab55fd",
                    "reference": "47a14338bf4ebd67d317bf1144253d7db4ab55fd",
                    "shasum": ""
                },
                "require": {
                    "clue/stream-filter": "^1.5",
                    "php": "^7.2 || ^8.0",
                    "psr/http-message": "^1.1 || ^2.0"
                },
                "provide": {
                    "php-http/message-factory-implementation": "1.0"
                },
                "require-dev": {
                    "ergebnis/composer-normalize": "^2.6",
                    "ext-zlib": "*",
                    "guzzlehttp/psr7": "^1.0 || ^2.0",
                    "laminas/laminas-diactoros": "^2.0 || ^3.0",
                    "php-http/message-factory": "^1.0.2",
                    "phpspec/phpspec": "^5.1 || ^6.3 || ^7.1",
                    "slim/slim": "^3.0"
                },
                "suggest": {
                    "ext-zlib": "Used with compressor/decompressor streams",
                    "guzzlehttp/psr7": "Used with Guzzle PSR-7 Factories",
                    "laminas/laminas-diactoros": "Used with Diactoros Factories",
                    "slim/slim": "Used with Slim Framework PSR-7 implementation"
                },
                "type": "library",
                "autoload": {
                    "files": [
                        "src/filters.php"
                    ],
                    "psr-4": {
                        "Http\\Message\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com"
                    }
                ],
                "description": "HTTP Message related tools",
                "homepage": "http://php-http.org",
                "keywords": [
                    "http",
                    "message",
                    "psr-7"
                ],
                "support": {
                    "issues": "https://github.com/php-http/message/issues",
                    "source": "https://github.com/php-http/message/tree/1.16.0"
                },
                "time": "2023-05-17T06:43:38+00:00"
            },
            {
                "name": "php-http/message-factory",
                "version": "1.1.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-http/message-factory.git",
                    "reference": "4d8778e1c7d405cbb471574821c1ff5b68cc8f57"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-http/message-factory/zipball/4d8778e1c7d405cbb471574821c1ff5b68cc8f57",
                    "reference": "4d8778e1c7d405cbb471574821c1ff5b68cc8f57",
                    "shasum": ""
                },
                "require": {
                    "php": ">=5.4",
                    "psr/http-message": "^1.0 || ^2.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Http\\Message\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com"
                    }
                ],
                "description": "Factory interfaces for PSR-7 HTTP Message",
                "homepage": "http://php-http.org",
                "keywords": [
                    "factory",
                    "http",
                    "message",
                    "stream",
                    "uri"
                ],
                "support": {
                    "issues": "https://github.com/php-http/message-factory/issues",
                    "source": "https://github.com/php-http/message-factory/tree/1.1.0"
                },
                "abandoned": "psr/http-factory",
                "time": "2023-04-14T14:16:17+00:00"
            },
            {
                "name": "php-http/promise",
                "version": "1.1.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-http/promise.git",
                    "reference": "4c4c1f9b7289a2ec57cde7f1e9762a5789506f88"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-http/promise/zipball/4c4c1f9b7289a2ec57cde7f1e9762a5789506f88",
                    "reference": "4c4c1f9b7289a2ec57cde7f1e9762a5789506f88",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.1 || ^8.0"
                },
                "require-dev": {
                    "friends-of-phpspec/phpspec-code-coverage": "^4.3.2",
                    "phpspec/phpspec": "^5.1.2 || ^6.2"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.1-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Http\\Promise\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Joel Wurtz",
                        "email": "joel.wurtz@gmail.com"
                    },
                    {
                        "name": "Márk Sági-Kazár",
                        "email": "mark.sagikazar@gmail.com"
                    }
                ],
                "description": "Promise used for asynchronous HTTP requests",
                "homepage": "http://httplug.io",
                "keywords": [
                    "promise"
                ],
                "support": {
                    "issues": "https://github.com/php-http/promise/issues",
                    "source": "https://github.com/php-http/promise/tree/1.1.0"
                },
                "time": "2020-07-07T09:29:14+00:00"
            },
            {
                "name": "phpdocumentor/reflection-common",
                "version": "2.2.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/phpDocumentor/ReflectionCommon.git",
                    "reference": "1d01c49d4ed62f25aa84a747ad35d5a16924662b"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/phpDocumentor/ReflectionCommon/zipball/1d01c49d4ed62f25aa84a747ad35d5a16924662b",
                    "reference": "1d01c49d4ed62f25aa84a747ad35d5a16924662b",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2 || ^8.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-2.x": "2.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "phpDocumentor\\Reflection\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Jaap van Otterdijk",
                        "email": "opensource@ijaap.nl"
                    }
                ],
                "description": "Common reflection classes used by phpdocumentor to reflect the code structure",
                "homepage": "http://www.phpdoc.org",
                "keywords": [
                    "FQSEN",
                    "phpDocumentor",
                    "phpdoc",
                    "reflection",
                    "static analysis"
                ],
                "support": {
                    "issues": "https://github.com/phpDocumentor/ReflectionCommon/issues",
                    "source": "https://github.com/phpDocumentor/ReflectionCommon/tree/2.x"
                },
                "time": "2020-06-27T09:03:43+00:00"
            },
            {
                "name": "phpdocumentor/reflection-docblock",
                "version": "5.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/phpDocumentor/ReflectionDocBlock.git",
                    "reference": "622548b623e81ca6d78b721c5e029f4ce664f170"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/phpDocumentor/ReflectionDocBlock/zipball/622548b623e81ca6d78b721c5e029f4ce664f170",
                    "reference": "622548b623e81ca6d78b721c5e029f4ce664f170",
                    "shasum": ""
                },
                "require": {
                    "ext-filter": "*",
                    "php": "^7.2 || ^8.0",
                    "phpdocumentor/reflection-common": "^2.2",
                    "phpdocumentor/type-resolver": "^1.3",
                    "webmozart/assert": "^1.9.1"
                },
                "require-dev": {
                    "mockery/mockery": "~1.3.2",
                    "psalm/phar": "^4.8"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "5.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "phpDocumentor\\Reflection\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Mike van Riel",
                        "email": "me@mikevanriel.com"
                    },
                    {
                        "name": "Jaap van Otterdijk",
                        "email": "account@ijaap.nl"
                    }
                ],
                "description": "With this component, a library can provide support for annotations via DocBlocks or otherwise retrieve information that is embedded in a DocBlock.",
                "support": {
                    "issues": "https://github.com/phpDocumentor/ReflectionDocBlock/issues",
                    "source": "https://github.com/phpDocumentor/ReflectionDocBlock/tree/5.3.0"
                },
                "time": "2021-10-19T17:43:47+00:00"
            },
            {
                "name": "phpdocumentor/type-resolver",
                "version": "1.7.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/phpDocumentor/TypeResolver.git",
                    "reference": "3219c6ee25c9ea71e3d9bbaf39c67c9ebd499419"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/phpDocumentor/TypeResolver/zipball/3219c6ee25c9ea71e3d9bbaf39c67c9ebd499419",
                    "reference": "3219c6ee25c9ea71e3d9bbaf39c67c9ebd499419",
                    "shasum": ""
                },
                "require": {
                    "doctrine/deprecations": "^1.0",
                    "php": "^7.4 || ^8.0",
                    "phpdocumentor/reflection-common": "^2.0",
                    "phpstan/phpdoc-parser": "^1.13"
                },
                "require-dev": {
                    "ext-tokenizer": "*",
                    "phpbench/phpbench": "^1.2",
                    "phpstan/extension-installer": "^1.1",
                    "phpstan/phpstan": "^1.8",
                    "phpstan/phpstan-phpunit": "^1.1",
                    "phpunit/phpunit": "^9.5",
                    "rector/rector": "^0.13.9",
                    "vimeo/psalm": "^4.25"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-1.x": "1.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "phpDocumentor\\Reflection\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Mike van Riel",
                        "email": "me@mikevanriel.com"
                    }
                ],
                "description": "A PSR-5 based resolver of Class names, Types and Structural Element Names",
                "support": {
                    "issues": "https://github.com/phpDocumentor/TypeResolver/issues",
                    "source": "https://github.com/phpDocumentor/TypeResolver/tree/1.7.3"
                },
                "time": "2023-08-12T11:01:26+00:00"
            },
            {
                "name": "phpstan/phpdoc-parser",
                "version": "1.23.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/phpstan/phpdoc-parser.git",
                    "reference": "846ae76eef31c6d7790fac9bc399ecee45160b26"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/phpstan/phpdoc-parser/zipball/846ae76eef31c6d7790fac9bc399ecee45160b26",
                    "reference": "846ae76eef31c6d7790fac9bc399ecee45160b26",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2 || ^8.0"
                },
                "require-dev": {
                    "doctrine/annotations": "^2.0",
                    "nikic/php-parser": "^4.15",
                    "php-parallel-lint/php-parallel-lint": "^1.2",
                    "phpstan/extension-installer": "^1.0",
                    "phpstan/phpstan": "^1.5",
                    "phpstan/phpstan-phpunit": "^1.1",
                    "phpstan/phpstan-strict-rules": "^1.0",
                    "phpunit/phpunit": "^9.5",
                    "symfony/process": "^5.2"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "PHPStan\\PhpDocParser\\": [
                            "src/"
                        ]
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "description": "PHPDoc parser with support for nullable, intersection and generic types",
                "support": {
                    "issues": "https://github.com/phpstan/phpdoc-parser/issues",
                    "source": "https://github.com/phpstan/phpdoc-parser/tree/1.23.1"
                },
                "time": "2023-08-03T16:32:59+00:00"
            },
            {
                "name": "psr/cache",
                "version": "3.0.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/cache.git",
                    "reference": "aa5030cfa5405eccfdcb1083ce040c2cb8d253bf"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/cache/zipball/aa5030cfa5405eccfdcb1083ce040c2cb8d253bf",
                    "reference": "aa5030cfa5405eccfdcb1083ce040c2cb8d253bf",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.0.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\Cache\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "https://www.php-fig.org/"
                    }
                ],
                "description": "Common interface for caching libraries",
                "keywords": [
                    "cache",
                    "psr",
                    "psr-6"
                ],
                "support": {
                    "source": "https://github.com/php-fig/cache/tree/3.0.0"
                },
                "time": "2021-02-03T23:26:27+00:00"
            },
            {
                "name": "psr/clock",
                "version": "1.0.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/clock.git",
                    "reference": "e41a24703d4560fd0acb709162f73b8adfc3aa0d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/clock/zipball/e41a24703d4560fd0acb709162f73b8adfc3aa0d",
                    "reference": "e41a24703d4560fd0acb709162f73b8adfc3aa0d",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.0 || ^8.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Psr\\Clock\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "https://www.php-fig.org/"
                    }
                ],
                "description": "Common interface for reading the clock.",
                "homepage": "https://github.com/php-fig/clock",
                "keywords": [
                    "clock",
                    "now",
                    "psr",
                    "psr-20",
                    "time"
                ],
                "support": {
                    "issues": "https://github.com/php-fig/clock/issues",
                    "source": "https://github.com/php-fig/clock/tree/1.0.0"
                },
                "time": "2022-11-25T14:36:26+00:00"
            },
            {
                "name": "psr/container",
                "version": "2.0.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/container.git",
                    "reference": "c71ecc56dfe541dbd90c5360474fbc405f8d5963"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/container/zipball/c71ecc56dfe541dbd90c5360474fbc405f8d5963",
                    "reference": "c71ecc56dfe541dbd90c5360474fbc405f8d5963",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.4.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\Container\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "https://www.php-fig.org/"
                    }
                ],
                "description": "Common Container Interface (PHP FIG PSR-11)",
                "homepage": "https://github.com/php-fig/container",
                "keywords": [
                    "PSR-11",
                    "container",
                    "container-interface",
                    "container-interop",
                    "psr"
                ],
                "support": {
                    "issues": "https://github.com/php-fig/container/issues",
                    "source": "https://github.com/php-fig/container/tree/2.0.2"
                },
                "time": "2021-11-05T16:47:00+00:00"
            },
            {
                "name": "psr/event-dispatcher",
                "version": "1.0.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/event-dispatcher.git",
                    "reference": "dbefd12671e8a14ec7f180cab83036ed26714bb0"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/event-dispatcher/zipball/dbefd12671e8a14ec7f180cab83036ed26714bb0",
                    "reference": "dbefd12671e8a14ec7f180cab83036ed26714bb0",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.2.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\EventDispatcher\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "http://www.php-fig.org/"
                    }
                ],
                "description": "Standard interfaces for event handling.",
                "keywords": [
                    "events",
                    "psr",
                    "psr-14"
                ],
                "support": {
                    "issues": "https://github.com/php-fig/event-dispatcher/issues",
                    "source": "https://github.com/php-fig/event-dispatcher/tree/1.0.0"
                },
                "time": "2019-01-08T18:20:26+00:00"
            },
            {
                "name": "psr/http-client",
                "version": "1.0.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/http-client.git",
                    "reference": "0955afe48220520692d2d09f7ab7e0f93ffd6a31"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/http-client/zipball/0955afe48220520692d2d09f7ab7e0f93ffd6a31",
                    "reference": "0955afe48220520692d2d09f7ab7e0f93ffd6a31",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.0 || ^8.0",
                    "psr/http-message": "^1.0 || ^2.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\Http\\Client\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "https://www.php-fig.org/"
                    }
                ],
                "description": "Common interface for HTTP clients",
                "homepage": "https://github.com/php-fig/http-client",
                "keywords": [
                    "http",
                    "http-client",
                    "psr",
                    "psr-18"
                ],
                "support": {
                    "source": "https://github.com/php-fig/http-client/tree/1.0.2"
                },
                "time": "2023-04-10T20:12:12+00:00"
            },
            {
                "name": "psr/http-factory",
                "version": "1.0.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/http-factory.git",
                    "reference": "e616d01114759c4c489f93b099585439f795fe35"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/http-factory/zipball/e616d01114759c4c489f93b099585439f795fe35",
                    "reference": "e616d01114759c4c489f93b099585439f795fe35",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.0.0",
                    "psr/http-message": "^1.0 || ^2.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\Http\\Message\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "https://www.php-fig.org/"
                    }
                ],
                "description": "Common interfaces for PSR-7 HTTP message factories",
                "keywords": [
                    "factory",
                    "http",
                    "message",
                    "psr",
                    "psr-17",
                    "psr-7",
                    "request",
                    "response"
                ],
                "support": {
                    "source": "https://github.com/php-fig/http-factory/tree/1.0.2"
                },
                "time": "2023-04-10T20:10:41+00:00"
            },
            {
                "name": "psr/http-message",
                "version": "2.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/http-message.git",
                    "reference": "402d35bcb92c70c026d1a6a9883f06b2ead23d71"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/http-message/zipball/402d35bcb92c70c026d1a6a9883f06b2ead23d71",
                    "reference": "402d35bcb92c70c026d1a6a9883f06b2ead23d71",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2 || ^8.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\Http\\Message\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "https://www.php-fig.org/"
                    }
                ],
                "description": "Common interface for HTTP messages",
                "homepage": "https://github.com/php-fig/http-message",
                "keywords": [
                    "http",
                    "http-message",
                    "psr",
                    "psr-7",
                    "request",
                    "response"
                ],
                "support": {
                    "source": "https://github.com/php-fig/http-message/tree/2.0"
                },
                "time": "2023-04-04T09:54:51+00:00"
            },
            {
                "name": "psr/link",
                "version": "2.0.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/link.git",
                    "reference": "84b159194ecfd7eaa472280213976e96415433f7"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/link/zipball/84b159194ecfd7eaa472280213976e96415433f7",
                    "reference": "84b159194ecfd7eaa472280213976e96415433f7",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.0.0"
                },
                "suggest": {
                    "fig/link-util": "Provides some useful PSR-13 utilities"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\Link\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "http://www.php-fig.org/"
                    }
                ],
                "description": "Common interfaces for HTTP links",
                "homepage": "https://github.com/php-fig/link",
                "keywords": [
                    "http",
                    "http-link",
                    "link",
                    "psr",
                    "psr-13",
                    "rest"
                ],
                "support": {
                    "source": "https://github.com/php-fig/link/tree/2.0.1"
                },
                "time": "2021-03-11T23:00:27+00:00"
            },
            {
                "name": "psr/log",
                "version": "3.0.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/php-fig/log.git",
                    "reference": "fe5ea303b0887d5caefd3d431c3e61ad47037001"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/php-fig/log/zipball/fe5ea303b0887d5caefd3d431c3e61ad47037001",
                    "reference": "fe5ea303b0887d5caefd3d431c3e61ad47037001",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.0.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Psr\\Log\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "PHP-FIG",
                        "homepage": "https://www.php-fig.org/"
                    }
                ],
                "description": "Common interface for logging libraries",
                "homepage": "https://github.com/php-fig/log",
                "keywords": [
                    "log",
                    "psr",
                    "psr-3"
                ],
                "support": {
                    "source": "https://github.com/php-fig/log/tree/3.0.0"
                },
                "time": "2021-07-14T16:46:02+00:00"
            },
            {
                "name": "ralouphie/getallheaders",
                "version": "3.0.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/ralouphie/getallheaders.git",
                    "reference": "120b605dfeb996808c31b6477290a714d356e822"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/ralouphie/getallheaders/zipball/120b605dfeb996808c31b6477290a714d356e822",
                    "reference": "120b605dfeb996808c31b6477290a714d356e822",
                    "shasum": ""
                },
                "require": {
                    "php": ">=5.6"
                },
                "require-dev": {
                    "php-coveralls/php-coveralls": "^2.1",
                    "phpunit/phpunit": "^5 || ^6.5"
                },
                "type": "library",
                "autoload": {
                    "files": [
                        "src/getallheaders.php"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Ralph Khattar",
                        "email": "ralph.khattar@gmail.com"
                    }
                ],
                "description": "A polyfill for getallheaders.",
                "support": {
                    "issues": "https://github.com/ralouphie/getallheaders/issues",
                    "source": "https://github.com/ralouphie/getallheaders/tree/develop"
                },
                "time": "2019-03-08T08:55:37+00:00"
            },
            {
                "name": "symfony/asset",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/asset.git",
                    "reference": "b77a4cc8e266b7e0db688de740f9ee7253aa411c"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/asset/zipball/b77a4cc8e266b7e0db688de740f9ee7253aa411c",
                    "reference": "b77a4cc8e266b7e0db688de740f9ee7253aa411c",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "conflict": {
                    "symfony/http-foundation": "<5.4"
                },
                "require-dev": {
                    "symfony/http-client": "^5.4|^6.0",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Asset\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Manages URL generation and versioning of web assets such as CSS stylesheets, JavaScript files and image files",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/asset/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-04-21T14:41:17+00:00"
            },
            {
                "name": "symfony/cache",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/cache.git",
                    "reference": "d176b97600860df13e851538c2df2ad88e9e5ca9"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/cache/zipball/d176b97600860df13e851538c2df2ad88e9e5ca9",
                    "reference": "d176b97600860df13e851538c2df2ad88e9e5ca9",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/cache": "^2.0|^3.0",
                    "psr/log": "^1.1|^2|^3",
                    "symfony/cache-contracts": "^2.5|^3",
                    "symfony/service-contracts": "^2.5|^3",
                    "symfony/var-exporter": "^6.2.10"
                },
                "conflict": {
                    "doctrine/dbal": "<2.13.1",
                    "symfony/dependency-injection": "<5.4",
                    "symfony/http-kernel": "<5.4",
                    "symfony/var-dumper": "<5.4"
                },
                "provide": {
                    "psr/cache-implementation": "2.0|3.0",
                    "psr/simple-cache-implementation": "1.0|2.0|3.0",
                    "symfony/cache-implementation": "1.1|2.0|3.0"
                },
                "require-dev": {
                    "cache/integration-tests": "dev-master",
                    "doctrine/dbal": "^2.13.1|^3.0",
                    "predis/predis": "^1.1|^2.0",
                    "psr/simple-cache": "^1.0|^2.0|^3.0",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/filesystem": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/messenger": "^5.4|^6.0",
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Cache\\": ""
                    },
                    "classmap": [
                        "Traits/ValueWrapper.php"
                    ],
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides extended PSR-6, PSR-16 (and tags) implementations",
                "homepage": "https://symfony.com",
                "keywords": [
                    "caching",
                    "psr6"
                ],
                "support": {
                    "source": "https://github.com/symfony/cache/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-27T16:19:14+00:00"
            },
            {
                "name": "symfony/cache-contracts",
                "version": "v3.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/cache-contracts.git",
                    "reference": "ad945640ccc0ae6e208bcea7d7de4b39b569896b"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/cache-contracts/zipball/ad945640ccc0ae6e208bcea7d7de4b39b569896b",
                    "reference": "ad945640ccc0ae6e208bcea7d7de4b39b569896b",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/cache": "^3.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.4-dev"
                    },
                    "thanks": {
                        "name": "symfony/contracts",
                        "url": "https://github.com/symfony/contracts"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Contracts\\Cache\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Generic abstractions related to caching",
                "homepage": "https://symfony.com",
                "keywords": [
                    "abstractions",
                    "contracts",
                    "decoupling",
                    "interfaces",
                    "interoperability",
                    "standards"
                ],
                "support": {
                    "source": "https://github.com/symfony/cache-contracts/tree/v3.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-23T14:45:45+00:00"
            },
            {
                "name": "symfony/clock",
                "version": "v6.3.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/clock.git",
                    "reference": "2c72817f85cbdd0ae4e49643514a889004934296"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/clock/zipball/2c72817f85cbdd0ae4e49643514a889004934296",
                    "reference": "2c72817f85cbdd0ae4e49643514a889004934296",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/clock": "^1.0"
                },
                "provide": {
                    "psr/clock-implementation": "1.0"
                },
                "type": "library",
                "autoload": {
                    "files": [
                        "Resources/now.php"
                    ],
                    "psr-4": {
                        "Symfony\\Component\\Clock\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Decouples applications from the system clock",
                "homepage": "https://symfony.com",
                "keywords": [
                    "clock",
                    "psr20",
                    "time"
                ],
                "support": {
                    "source": "https://github.com/symfony/clock/tree/v6.3.1"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-08T23:46:55+00:00"
            },
            {
                "name": "symfony/config",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/config.git",
                    "reference": "b47ca238b03e7b0d7880ffd1cf06e8d637ca1467"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/config/zipball/b47ca238b03e7b0d7880ffd1cf06e8d637ca1467",
                    "reference": "b47ca238b03e7b0d7880ffd1cf06e8d637ca1467",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/filesystem": "^5.4|^6.0",
                    "symfony/polyfill-ctype": "~1.8"
                },
                "conflict": {
                    "symfony/finder": "<5.4",
                    "symfony/service-contracts": "<2.5"
                },
                "require-dev": {
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/messenger": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3",
                    "symfony/yaml": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Config\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Helps you find, load, combine, autofill and validate configuration values of any kind",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/config/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-19T20:22:16+00:00"
            },
            {
                "name": "symfony/console",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/console.git",
                    "reference": "aa5d64ad3f63f2e48964fc81ee45cb318a723898"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/console/zipball/aa5d64ad3f63f2e48964fc81ee45cb318a723898",
                    "reference": "aa5d64ad3f63f2e48964fc81ee45cb318a723898",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-mbstring": "~1.0",
                    "symfony/service-contracts": "^2.5|^3",
                    "symfony/string": "^5.4|^6.0"
                },
                "conflict": {
                    "symfony/dependency-injection": "<5.4",
                    "symfony/dotenv": "<5.4",
                    "symfony/event-dispatcher": "<5.4",
                    "symfony/lock": "<5.4",
                    "symfony/process": "<5.4"
                },
                "provide": {
                    "psr/log-implementation": "1.0|2.0|3.0"
                },
                "require-dev": {
                    "psr/log": "^1|^2|^3",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/lock": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0",
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Console\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Eases the creation of beautiful and testable command line interfaces",
                "homepage": "https://symfony.com",
                "keywords": [
                    "cli",
                    "command-line",
                    "console",
                    "terminal"
                ],
                "support": {
                    "source": "https://github.com/symfony/console/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-19T20:17:28+00:00"
            },
            {
                "name": "symfony/dependency-injection",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/dependency-injection.git",
                    "reference": "474cfbc46aba85a1ca11a27db684480d0db64ba7"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/dependency-injection/zipball/474cfbc46aba85a1ca11a27db684480d0db64ba7",
                    "reference": "474cfbc46aba85a1ca11a27db684480d0db64ba7",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/container": "^1.1|^2.0",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/service-contracts": "^2.5|^3.0",
                    "symfony/var-exporter": "^6.2.10"
                },
                "conflict": {
                    "ext-psr": "<1.1|>=2",
                    "symfony/config": "<6.1",
                    "symfony/finder": "<5.4",
                    "symfony/proxy-manager-bridge": "<6.3",
                    "symfony/yaml": "<5.4"
                },
                "provide": {
                    "psr/container-implementation": "1.1|2.0",
                    "symfony/service-implementation": "1.1|2.0|3.0"
                },
                "require-dev": {
                    "symfony/config": "^6.1",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\DependencyInjection\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Allows you to standardize and centralize the way objects are constructed in your application",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/dependency-injection/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-19T20:17:28+00:00"
            },
            {
                "name": "symfony/deprecation-contracts",
                "version": "v3.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/deprecation-contracts.git",
                    "reference": "7c3aff79d10325257a001fcf92d991f24fc967cf"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/deprecation-contracts/zipball/7c3aff79d10325257a001fcf92d991f24fc967cf",
                    "reference": "7c3aff79d10325257a001fcf92d991f24fc967cf",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.4-dev"
                    },
                    "thanks": {
                        "name": "symfony/contracts",
                        "url": "https://github.com/symfony/contracts"
                    }
                },
                "autoload": {
                    "files": [
                        "function.php"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "A generic function and convention to trigger deprecation notices",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/deprecation-contracts/tree/v3.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-23T14:45:45+00:00"
            },
            {
                "name": "symfony/doctrine-bridge",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/doctrine-bridge.git",
                    "reference": "61c7d16fbb61ffe3a08d1b965355d6b1006c3594"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/doctrine-bridge/zipball/61c7d16fbb61ffe3a08d1b965355d6b1006c3594",
                    "reference": "61c7d16fbb61ffe3a08d1b965355d6b1006c3594",
                    "shasum": ""
                },
                "require": {
                    "doctrine/event-manager": "^1.2|^2",
                    "doctrine/persistence": "^2|^3",
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-ctype": "~1.8",
                    "symfony/polyfill-mbstring": "~1.0",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "conflict": {
                    "doctrine/annotations": "<1.13.1",
                    "doctrine/dbal": "<2.13.1",
                    "doctrine/lexer": "<1.1",
                    "doctrine/orm": "<2.12",
                    "symfony/cache": "<5.4",
                    "symfony/dependency-injection": "<6.2",
                    "symfony/form": "<5.4.21|>=6,<6.2.7",
                    "symfony/http-foundation": "<6.3",
                    "symfony/http-kernel": "<6.2",
                    "symfony/lock": "<6.3",
                    "symfony/messenger": "<5.4",
                    "symfony/property-info": "<5.4",
                    "symfony/security-bundle": "<5.4",
                    "symfony/security-core": "<6.0",
                    "symfony/validator": "<5.4.25|>=6,<6.2.12|>=6.3,<6.3.1"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.13.1|^2",
                    "doctrine/collections": "^1.0|^2.0",
                    "doctrine/data-fixtures": "^1.1",
                    "doctrine/dbal": "^2.13.1|^3.0",
                    "doctrine/orm": "^2.12",
                    "psr/log": "^1|^2|^3",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/dependency-injection": "^6.2",
                    "symfony/doctrine-messenger": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/form": "^5.4.21|^6.2.7",
                    "symfony/http-kernel": "^6.3",
                    "symfony/lock": "^6.3",
                    "symfony/messenger": "^5.4|^6.0",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/property-info": "^5.4|^6.0",
                    "symfony/proxy-manager-bridge": "^5.4|^6.0",
                    "symfony/security-core": "^6.0",
                    "symfony/stopwatch": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "symfony/uid": "^5.4|^6.0",
                    "symfony/validator": "^5.4.25|~6.2.12|^6.3.1",
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "type": "symfony-bridge",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bridge\\Doctrine\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides integration for Doctrine with various Symfony components",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/doctrine-bridge/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-20T14:51:28+00:00"
            },
            {
                "name": "symfony/doctrine-messenger",
                "version": "v6.3.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/doctrine-messenger.git",
                    "reference": "f1c253e24ae6d2bc4939b1439e074e6d2e73ecdb"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/doctrine-messenger/zipball/f1c253e24ae6d2bc4939b1439e074e6d2e73ecdb",
                    "reference": "f1c253e24ae6d2bc4939b1439e074e6d2e73ecdb",
                    "shasum": ""
                },
                "require": {
                    "doctrine/dbal": "^2.13|^3.0",
                    "php": ">=8.1",
                    "symfony/messenger": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "conflict": {
                    "doctrine/persistence": "<1.3"
                },
                "require-dev": {
                    "doctrine/persistence": "^1.3|^2|^3",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/serializer": "^5.4|^6.0"
                },
                "type": "symfony-messenger-bridge",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Messenger\\Bridge\\Doctrine\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony Doctrine Messenger Bridge",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/doctrine-messenger/tree/v6.3.1"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-24T11:51:27+00:00"
            },
            {
                "name": "symfony/dom-crawler",
                "version": "v6.3.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/dom-crawler.git",
                    "reference": "8aa333f41f05afc7fc285a976b58272fd90fc212"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/dom-crawler/zipball/8aa333f41f05afc7fc285a976b58272fd90fc212",
                    "reference": "8aa333f41f05afc7fc285a976b58272fd90fc212",
                    "shasum": ""
                },
                "require": {
                    "masterminds/html5": "^2.6",
                    "php": ">=8.1",
                    "symfony/polyfill-ctype": "~1.8",
                    "symfony/polyfill-mbstring": "~1.0"
                },
                "require-dev": {
                    "symfony/css-selector": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\DomCrawler\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Eases DOM navigation for HTML and XML documents",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/dom-crawler/tree/v6.3.1"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-05T15:30:22+00:00"
            },
            {
                "name": "symfony/dotenv",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/dotenv.git",
                    "reference": "ceadb434fe2a6763a03d2d110441745834f3dd1e"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/dotenv/zipball/ceadb434fe2a6763a03d2d110441745834f3dd1e",
                    "reference": "ceadb434fe2a6763a03d2d110441745834f3dd1e",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "conflict": {
                    "symfony/console": "<5.4",
                    "symfony/process": "<5.4"
                },
                "require-dev": {
                    "symfony/console": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Dotenv\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Registers environment variables from a .env file",
                "homepage": "https://symfony.com",
                "keywords": [
                    "dotenv",
                    "env",
                    "environment"
                ],
                "support": {
                    "source": "https://github.com/symfony/dotenv/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-04-21T14:41:17+00:00"
            },
            {
                "name": "symfony/error-handler",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/error-handler.git",
                    "reference": "85fd65ed295c4078367c784e8a5a6cee30348b7a"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/error-handler/zipball/85fd65ed295c4078367c784e8a5a6cee30348b7a",
                    "reference": "85fd65ed295c4078367c784e8a5a6cee30348b7a",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/log": "^1|^2|^3",
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "conflict": {
                    "symfony/deprecation-contracts": "<2.5"
                },
                "require-dev": {
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/serializer": "^5.4|^6.0"
                },
                "bin": [
                    "Resources/bin/patch-type-declarations"
                ],
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\ErrorHandler\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides tools to manage errors and ease debugging PHP code",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/error-handler/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-16T17:05:46+00:00"
            },
            {
                "name": "symfony/event-dispatcher",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/event-dispatcher.git",
                    "reference": "adb01fe097a4ee930db9258a3cc906b5beb5cf2e"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/event-dispatcher/zipball/adb01fe097a4ee930db9258a3cc906b5beb5cf2e",
                    "reference": "adb01fe097a4ee930db9258a3cc906b5beb5cf2e",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/event-dispatcher-contracts": "^2.5|^3"
                },
                "conflict": {
                    "symfony/dependency-injection": "<5.4",
                    "symfony/service-contracts": "<2.5"
                },
                "provide": {
                    "psr/event-dispatcher-implementation": "1.0",
                    "symfony/event-dispatcher-implementation": "2.0|3.0"
                },
                "require-dev": {
                    "psr/log": "^1|^2|^3",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/error-handler": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3",
                    "symfony/stopwatch": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\EventDispatcher\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides tools that allow your application components to communicate with each other by dispatching events and listening to them",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/event-dispatcher/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-06T06:56:43+00:00"
            },
            {
                "name": "symfony/event-dispatcher-contracts",
                "version": "v3.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/event-dispatcher-contracts.git",
                    "reference": "a76aed96a42d2b521153fb382d418e30d18b59df"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/event-dispatcher-contracts/zipball/a76aed96a42d2b521153fb382d418e30d18b59df",
                    "reference": "a76aed96a42d2b521153fb382d418e30d18b59df",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/event-dispatcher": "^1"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.4-dev"
                    },
                    "thanks": {
                        "name": "symfony/contracts",
                        "url": "https://github.com/symfony/contracts"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Contracts\\EventDispatcher\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Generic abstractions related to dispatching event",
                "homepage": "https://symfony.com",
                "keywords": [
                    "abstractions",
                    "contracts",
                    "decoupling",
                    "interfaces",
                    "interoperability",
                    "standards"
                ],
                "support": {
                    "source": "https://github.com/symfony/event-dispatcher-contracts/tree/v3.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-23T14:45:45+00:00"
            },
            {
                "name": "symfony/expression-language",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/expression-language.git",
                    "reference": "6d560c4c80e7e328708efd923f93ad67e6a0c1c0"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/expression-language/zipball/6d560c4c80e7e328708efd923f93ad67e6a0c1c0",
                    "reference": "6d560c4c80e7e328708efd923f93ad67e6a0c1c0",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\ExpressionLanguage\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides an engine that can compile and evaluate expressions",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/expression-language/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-04-28T16:05:33+00:00"
            },
            {
                "name": "symfony/filesystem",
                "version": "v6.3.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/filesystem.git",
                    "reference": "edd36776956f2a6fcf577edb5b05eb0e3bdc52ae"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/filesystem/zipball/edd36776956f2a6fcf577edb5b05eb0e3bdc52ae",
                    "reference": "edd36776956f2a6fcf577edb5b05eb0e3bdc52ae",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/polyfill-ctype": "~1.8",
                    "symfony/polyfill-mbstring": "~1.8"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Filesystem\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides basic utilities for the filesystem",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/filesystem/tree/v6.3.1"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-01T08:30:39+00:00"
            },
            {
                "name": "symfony/finder",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/finder.git",
                    "reference": "9915db259f67d21eefee768c1abcf1cc61b1fc9e"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/finder/zipball/9915db259f67d21eefee768c1abcf1cc61b1fc9e",
                    "reference": "9915db259f67d21eefee768c1abcf1cc61b1fc9e",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "require-dev": {
                    "symfony/filesystem": "^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Finder\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Finds files and directories via an intuitive fluent interface",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/finder/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T08:31:44+00:00"
            },
            {
                "name": "symfony/flex",
                "version": "v2.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/flex.git",
                    "reference": "9c402af768c6c9f8126a9ffa192ecf7c16581e35"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/flex/zipball/9c402af768c6c9f8126a9ffa192ecf7c16581e35",
                    "reference": "9c402af768c6c9f8126a9ffa192ecf7c16581e35",
                    "shasum": ""
                },
                "require": {
                    "composer-plugin-api": "^2.1",
                    "php": ">=8.0"
                },
                "require-dev": {
                    "composer/composer": "^2.1",
                    "symfony/dotenv": "^5.4|^6.0",
                    "symfony/filesystem": "^5.4|^6.0",
                    "symfony/phpunit-bridge": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0"
                },
                "type": "composer-plugin",
                "extra": {
                    "class": "Symfony\\Flex\\Flex"
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Flex\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien.potencier@gmail.com"
                    }
                ],
                "description": "Composer plugin for Symfony",
                "support": {
                    "issues": "https://github.com/symfony/flex/issues",
                    "source": "https://github.com/symfony/flex/tree/v2.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-08-04T09:02:35+00:00"
            },
            {
                "name": "symfony/form",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/form.git",
                    "reference": "afdadf511e08bc6d4752afb869ce084276aca4e2"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/form/zipball/afdadf511e08bc6d4752afb869ce084276aca4e2",
                    "reference": "afdadf511e08bc6d4752afb869ce084276aca4e2",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/options-resolver": "^5.4|^6.0",
                    "symfony/polyfill-ctype": "~1.8",
                    "symfony/polyfill-intl-icu": "^1.21",
                    "symfony/polyfill-mbstring": "~1.0",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "conflict": {
                    "symfony/console": "<5.4",
                    "symfony/dependency-injection": "<5.4",
                    "symfony/doctrine-bridge": "<5.4.21|>=6,<6.2.7",
                    "symfony/error-handler": "<5.4",
                    "symfony/framework-bundle": "<5.4",
                    "symfony/http-kernel": "<5.4",
                    "symfony/translation": "<5.4",
                    "symfony/translation-contracts": "<2.5",
                    "symfony/twig-bridge": "<6.3"
                },
                "require-dev": {
                    "doctrine/collections": "^1.0|^2.0",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/html-sanitizer": "^6.1",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/intl": "^5.4|^6.0",
                    "symfony/security-core": "^6.2",
                    "symfony/security-csrf": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "symfony/uid": "^5.4|^6.0",
                    "symfony/validator": "^5.4|^6.0",
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Form\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Allows to easily create, process and reuse HTML forms",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/form/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-26T17:39:03+00:00"
            },
            {
                "name": "symfony/framework-bundle",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/framework-bundle.git",
                    "reference": "930fe7ee25a928b9b3627d717873ddd171430a82"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/framework-bundle/zipball/930fe7ee25a928b9b3627d717873ddd171430a82",
                    "reference": "930fe7ee25a928b9b3627d717873ddd171430a82",
                    "shasum": ""
                },
                "require": {
                    "composer-runtime-api": ">=2.1",
                    "ext-xml": "*",
                    "php": ">=8.1",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/config": "^6.1",
                    "symfony/dependency-injection": "^6.3.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/error-handler": "^6.1",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/filesystem": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/http-foundation": "^6.3",
                    "symfony/http-kernel": "^6.3",
                    "symfony/polyfill-mbstring": "~1.0",
                    "symfony/routing": "^5.4|^6.0"
                },
                "conflict": {
                    "doctrine/annotations": "<1.13.1",
                    "doctrine/persistence": "<1.3",
                    "phpdocumentor/reflection-docblock": "<3.2.2",
                    "phpdocumentor/type-resolver": "<1.4.0",
                    "symfony/asset": "<5.4",
                    "symfony/clock": "<6.3",
                    "symfony/console": "<5.4",
                    "symfony/dom-crawler": "<6.3",
                    "symfony/dotenv": "<5.4",
                    "symfony/form": "<5.4",
                    "symfony/http-client": "<6.3",
                    "symfony/lock": "<5.4",
                    "symfony/mailer": "<5.4",
                    "symfony/messenger": "<6.3",
                    "symfony/mime": "<6.2",
                    "symfony/property-access": "<5.4",
                    "symfony/property-info": "<5.4",
                    "symfony/security-core": "<5.4",
                    "symfony/security-csrf": "<5.4",
                    "symfony/serializer": "<6.3",
                    "symfony/stopwatch": "<5.4",
                    "symfony/translation": "<6.2.8",
                    "symfony/twig-bridge": "<5.4",
                    "symfony/twig-bundle": "<5.4",
                    "symfony/validator": "<6.3",
                    "symfony/web-profiler-bundle": "<5.4",
                    "symfony/workflow": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.13.1|^2",
                    "doctrine/persistence": "^1.3|^2|^3",
                    "phpdocumentor/reflection-docblock": "^3.0|^4.0|^5.0",
                    "symfony/asset": "^5.4|^6.0",
                    "symfony/asset-mapper": "^6.3",
                    "symfony/browser-kit": "^5.4|^6.0",
                    "symfony/clock": "^6.2",
                    "symfony/console": "^5.4.9|^6.0.9",
                    "symfony/css-selector": "^5.4|^6.0",
                    "symfony/dom-crawler": "^6.3",
                    "symfony/dotenv": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/form": "^5.4|^6.0",
                    "symfony/html-sanitizer": "^6.1",
                    "symfony/http-client": "^6.3",
                    "symfony/lock": "^5.4|^6.0",
                    "symfony/mailer": "^5.4|^6.0",
                    "symfony/messenger": "^6.3",
                    "symfony/mime": "^6.2",
                    "symfony/notifier": "^5.4|^6.0",
                    "symfony/polyfill-intl-icu": "~1.0",
                    "symfony/process": "^5.4|^6.0",
                    "symfony/property-info": "^5.4|^6.0",
                    "symfony/rate-limiter": "^5.4|^6.0",
                    "symfony/scheduler": "^6.3",
                    "symfony/security-bundle": "^5.4|^6.0",
                    "symfony/semaphore": "^5.4|^6.0",
                    "symfony/serializer": "^6.3",
                    "symfony/stopwatch": "^5.4|^6.0",
                    "symfony/string": "^5.4|^6.0",
                    "symfony/translation": "^6.2.8",
                    "symfony/twig-bundle": "^5.4|^6.0",
                    "symfony/uid": "^5.4|^6.0",
                    "symfony/validator": "^6.3",
                    "symfony/web-link": "^5.4|^6.0",
                    "symfony/workflow": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0",
                    "twig/twig": "^2.10|^3.0"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bundle\\FrameworkBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides a tight integration between Symfony components and the Symfony full-stack framework",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/framework-bundle/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-26T17:39:03+00:00"
            },
            {
                "name": "symfony/google-mailer",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/google-mailer.git",
                    "reference": "7e6cde8d40144e889e607bfc5320ea4192b247cd"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/google-mailer/zipball/7e6cde8d40144e889e607bfc5320ea4192b247cd",
                    "reference": "7e6cde8d40144e889e607bfc5320ea4192b247cd",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/mailer": "^5.4.21|^6.2.7"
                },
                "require-dev": {
                    "symfony/http-client": "^5.4|^6.0"
                },
                "type": "symfony-mailer-bridge",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Mailer\\Bridge\\Google\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony Google Mailer Bridge",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/google-mailer/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-04-14T16:23:31+00:00"
            },
            {
                "name": "symfony/http-client",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/http-client.git",
                    "reference": "15f9f4bad62bfcbe48b5dedd866f04a08fc7ff00"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/http-client/zipball/15f9f4bad62bfcbe48b5dedd866f04a08fc7ff00",
                    "reference": "15f9f4bad62bfcbe48b5dedd866f04a08fc7ff00",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/log": "^1|^2|^3",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/http-client-contracts": "^3",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "conflict": {
                    "php-http/discovery": "<1.15",
                    "symfony/http-foundation": "<6.3"
                },
                "provide": {
                    "php-http/async-client-implementation": "*",
                    "php-http/client-implementation": "*",
                    "psr/http-client-implementation": "1.0",
                    "symfony/http-client-implementation": "3.0"
                },
                "require-dev": {
                    "amphp/amp": "^2.5",
                    "amphp/http-client": "^4.2.1",
                    "amphp/http-tunnel": "^1.0",
                    "amphp/socket": "^1.1",
                    "guzzlehttp/promises": "^1.4",
                    "nyholm/psr7": "^1.0",
                    "php-http/httplug": "^1.0|^2.0",
                    "psr/http-client": "^1.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0",
                    "symfony/stopwatch": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\HttpClient\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides powerful methods to fetch HTTP resources synchronously or asynchronously",
                "homepage": "https://symfony.com",
                "keywords": [
                    "http"
                ],
                "support": {
                    "source": "https://github.com/symfony/http-client/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-05T08:41:27+00:00"
            },
            {
                "name": "symfony/http-client-contracts",
                "version": "v3.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/http-client-contracts.git",
                    "reference": "3b66325d0176b4ec826bffab57c9037d759c31fb"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/http-client-contracts/zipball/3b66325d0176b4ec826bffab57c9037d759c31fb",
                    "reference": "3b66325d0176b4ec826bffab57c9037d759c31fb",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.4-dev"
                    },
                    "thanks": {
                        "name": "symfony/contracts",
                        "url": "https://github.com/symfony/contracts"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Contracts\\HttpClient\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Test/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Generic abstractions related to HTTP clients",
                "homepage": "https://symfony.com",
                "keywords": [
                    "abstractions",
                    "contracts",
                    "decoupling",
                    "interfaces",
                    "interoperability",
                    "standards"
                ],
                "support": {
                    "source": "https://github.com/symfony/http-client-contracts/tree/v3.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-23T14:45:45+00:00"
            },
            {
                "name": "symfony/http-foundation",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/http-foundation.git",
                    "reference": "43ed99d30f5f466ffa00bdac3f5f7aa9cd7617c3"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/http-foundation/zipball/43ed99d30f5f466ffa00bdac3f5f7aa9cd7617c3",
                    "reference": "43ed99d30f5f466ffa00bdac3f5f7aa9cd7617c3",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-mbstring": "~1.1",
                    "symfony/polyfill-php83": "^1.27"
                },
                "conflict": {
                    "symfony/cache": "<6.2"
                },
                "require-dev": {
                    "doctrine/dbal": "^2.13.1|^3.0",
                    "predis/predis": "^1.1|^2.0",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4.12|^6.0.12|^6.1.4",
                    "symfony/mime": "^5.4|^6.0",
                    "symfony/rate-limiter": "^5.2|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\HttpFoundation\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Defines an object-oriented layer for the HTTP specification",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/http-foundation/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-23T21:58:39+00:00"
            },
            {
                "name": "symfony/http-kernel",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/http-kernel.git",
                    "reference": "d3b567f0addf695e10b0c6d57564a9bea2e058ee"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/http-kernel/zipball/d3b567f0addf695e10b0c6d57564a9bea2e058ee",
                    "reference": "d3b567f0addf695e10b0c6d57564a9bea2e058ee",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/log": "^1|^2|^3",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/error-handler": "^6.3",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/http-foundation": "^6.2.7",
                    "symfony/polyfill-ctype": "^1.8"
                },
                "conflict": {
                    "symfony/browser-kit": "<5.4",
                    "symfony/cache": "<5.4",
                    "symfony/config": "<6.1",
                    "symfony/console": "<5.4",
                    "symfony/dependency-injection": "<6.3",
                    "symfony/doctrine-bridge": "<5.4",
                    "symfony/form": "<5.4",
                    "symfony/http-client": "<5.4",
                    "symfony/http-client-contracts": "<2.5",
                    "symfony/mailer": "<5.4",
                    "symfony/messenger": "<5.4",
                    "symfony/translation": "<5.4",
                    "symfony/translation-contracts": "<2.5",
                    "symfony/twig-bridge": "<5.4",
                    "symfony/validator": "<5.4",
                    "symfony/var-dumper": "<6.3",
                    "twig/twig": "<2.13"
                },
                "provide": {
                    "psr/log-implementation": "1.0|2.0|3.0"
                },
                "require-dev": {
                    "psr/cache": "^1.0|^2.0|^3.0",
                    "symfony/browser-kit": "^5.4|^6.0",
                    "symfony/clock": "^6.2",
                    "symfony/config": "^6.1",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/css-selector": "^5.4|^6.0",
                    "symfony/dependency-injection": "^6.3",
                    "symfony/dom-crawler": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/http-client-contracts": "^2.5|^3",
                    "symfony/process": "^5.4|^6.0",
                    "symfony/property-access": "^5.4.5|^6.0.5",
                    "symfony/routing": "^5.4|^6.0",
                    "symfony/serializer": "^6.3",
                    "symfony/stopwatch": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "symfony/translation-contracts": "^2.5|^3",
                    "symfony/uid": "^5.4|^6.0",
                    "symfony/validator": "^6.3",
                    "symfony/var-exporter": "^6.2",
                    "twig/twig": "^2.13|^3.0.4"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\HttpKernel\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides a structured process for converting a Request into a Response",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/http-kernel/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T10:33:00+00:00"
            },
            {
                "name": "symfony/intl",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/intl.git",
                    "reference": "1f8cb145c869ed089a8531c51a6a4b31ed0b3c69"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/intl/zipball/1f8cb145c869ed089a8531c51a6a4b31ed0b3c69",
                    "reference": "1f8cb145c869ed089a8531c51a6a4b31ed0b3c69",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "require-dev": {
                    "symfony/filesystem": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/var-exporter": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Intl\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Bernhard Schussek",
                        "email": "bschussek@gmail.com"
                    },
                    {
                        "name": "Eriksen Costa",
                        "email": "eriksen.costa@infranology.com.br"
                    },
                    {
                        "name": "Igor Wiedler",
                        "email": "igor@wiedler.ch"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides access to the localization data of the ICU library",
                "homepage": "https://symfony.com",
                "keywords": [
                    "i18n",
                    "icu",
                    "internationalization",
                    "intl",
                    "l10n",
                    "localization"
                ],
                "support": {
                    "source": "https://github.com/symfony/intl/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-20T07:43:09+00:00"
            },
            {
                "name": "symfony/mailer",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/mailer.git",
                    "reference": "7b03d9be1dea29bfec0a6c7b603f5072a4c97435"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/mailer/zipball/7b03d9be1dea29bfec0a6c7b603f5072a4c97435",
                    "reference": "7b03d9be1dea29bfec0a6c7b603f5072a4c97435",
                    "shasum": ""
                },
                "require": {
                    "egulias/email-validator": "^2.1.10|^3|^4",
                    "php": ">=8.1",
                    "psr/event-dispatcher": "^1",
                    "psr/log": "^1|^2|^3",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/mime": "^6.2",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "conflict": {
                    "symfony/http-client-contracts": "<2.5",
                    "symfony/http-kernel": "<5.4",
                    "symfony/messenger": "<6.2",
                    "symfony/mime": "<6.2",
                    "symfony/twig-bridge": "<6.2.1"
                },
                "require-dev": {
                    "symfony/console": "^5.4|^6.0",
                    "symfony/http-client": "^5.4|^6.0",
                    "symfony/messenger": "^6.2",
                    "symfony/twig-bridge": "^6.2"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Mailer\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Helps sending emails",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/mailer/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-29T12:49:39+00:00"
            },
            {
                "name": "symfony/messenger",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/messenger.git",
                    "reference": "38a1f47041a4081bcb44827db8481a5368dd58ef"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/messenger/zipball/38a1f47041a4081bcb44827db8481a5368dd58ef",
                    "reference": "38a1f47041a4081bcb44827db8481a5368dd58ef",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/log": "^1|^2|^3",
                    "symfony/clock": "^6.3"
                },
                "conflict": {
                    "symfony/event-dispatcher": "<5.4",
                    "symfony/event-dispatcher-contracts": "<2.5",
                    "symfony/framework-bundle": "<5.4",
                    "symfony/http-kernel": "<5.4",
                    "symfony/serializer": "<5.4"
                },
                "require-dev": {
                    "psr/cache": "^1.0|^2.0|^3.0",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/rate-limiter": "^5.4|^6.0",
                    "symfony/routing": "^5.4|^6.0",
                    "symfony/serializer": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3",
                    "symfony/stopwatch": "^5.4|^6.0",
                    "symfony/validator": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Messenger\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Samuel Roze",
                        "email": "samuel.roze@gmail.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Helps applications send and receive messages to/from other applications or via message queues",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/messenger/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/mime",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/mime.git",
                    "reference": "9a0cbd52baa5ba5a5b1f0cacc59466f194730f98"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/mime/zipball/9a0cbd52baa5ba5a5b1f0cacc59466f194730f98",
                    "reference": "9a0cbd52baa5ba5a5b1f0cacc59466f194730f98",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-intl-idn": "^1.10",
                    "symfony/polyfill-mbstring": "^1.0"
                },
                "conflict": {
                    "egulias/email-validator": "~3.0.0",
                    "phpdocumentor/reflection-docblock": "<3.2.2",
                    "phpdocumentor/type-resolver": "<1.4.0",
                    "symfony/mailer": "<5.4",
                    "symfony/serializer": "<6.2.13|>=6.3,<6.3.2"
                },
                "require-dev": {
                    "egulias/email-validator": "^2.1.10|^3.1|^4",
                    "league/html-to-markdown": "^5.0",
                    "phpdocumentor/reflection-docblock": "^3.0|^4.0|^5.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/property-info": "^5.4|^6.0",
                    "symfony/serializer": "~6.2.13|^6.3.2"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Mime\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Allows manipulating MIME messages",
                "homepage": "https://symfony.com",
                "keywords": [
                    "mime",
                    "mime-type"
                ],
                "support": {
                    "source": "https://github.com/symfony/mime/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/monolog-bridge",
                "version": "v6.3.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/monolog-bridge.git",
                    "reference": "04b04b8e465e0fa84940e5609b6796a8b4e51bf1"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/monolog-bridge/zipball/04b04b8e465e0fa84940e5609b6796a8b4e51bf1",
                    "reference": "04b04b8e465e0fa84940e5609b6796a8b4e51bf1",
                    "shasum": ""
                },
                "require": {
                    "monolog/monolog": "^1.25.1|^2|^3",
                    "php": ">=8.1",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "conflict": {
                    "symfony/console": "<5.4",
                    "symfony/http-foundation": "<5.4",
                    "symfony/security-core": "<6.0"
                },
                "require-dev": {
                    "symfony/console": "^5.4|^6.0",
                    "symfony/http-client": "^5.4|^6.0",
                    "symfony/mailer": "^5.4|^6.0",
                    "symfony/messenger": "^5.4|^6.0",
                    "symfony/mime": "^5.4|^6.0",
                    "symfony/security-core": "^6.0",
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "type": "symfony-bridge",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bridge\\Monolog\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides integration for Monolog with various Symfony components",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/monolog-bridge/tree/v6.3.1"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-06-08T11:13:32+00:00"
            },
            {
                "name": "symfony/monolog-bundle",
                "version": "v3.8.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/monolog-bundle.git",
                    "reference": "a41bbcdc1105603b6d73a7d9a43a3788f8e0fb7d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/monolog-bundle/zipball/a41bbcdc1105603b6d73a7d9a43a3788f8e0fb7d",
                    "reference": "a41bbcdc1105603b6d73a7d9a43a3788f8e0fb7d",
                    "shasum": ""
                },
                "require": {
                    "monolog/monolog": "^1.22 || ^2.0 || ^3.0",
                    "php": ">=7.1.3",
                    "symfony/config": "~4.4 || ^5.0 || ^6.0",
                    "symfony/dependency-injection": "^4.4 || ^5.0 || ^6.0",
                    "symfony/http-kernel": "~4.4 || ^5.0 || ^6.0",
                    "symfony/monolog-bridge": "~4.4 || ^5.0 || ^6.0"
                },
                "require-dev": {
                    "symfony/console": "~4.4 || ^5.0 || ^6.0",
                    "symfony/phpunit-bridge": "^5.2 || ^6.0",
                    "symfony/yaml": "~4.4 || ^5.0 || ^6.0"
                },
                "type": "symfony-bundle",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.x-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bundle\\MonologBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony MonologBundle",
                "homepage": "https://symfony.com",
                "keywords": [
                    "log",
                    "logging"
                ],
                "support": {
                    "issues": "https://github.com/symfony/monolog-bundle/issues",
                    "source": "https://github.com/symfony/monolog-bundle/tree/v3.8.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-05-10T14:24:36+00:00"
            },
            {
                "name": "symfony/notifier",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/notifier.git",
                    "reference": "a30aee1bf767835d7948138c1629e310cee26a8b"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/notifier/zipball/a30aee1bf767835d7948138c1629e310cee26a8b",
                    "reference": "a30aee1bf767835d7948138c1629e310cee26a8b",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/log": "^1|^2|^3"
                },
                "conflict": {
                    "symfony/event-dispatcher": "<5.4",
                    "symfony/event-dispatcher-contracts": "<2.5",
                    "symfony/http-client-contracts": "<2.5",
                    "symfony/http-kernel": "<5.4"
                },
                "require-dev": {
                    "symfony/event-dispatcher-contracts": "^2.5|^3",
                    "symfony/http-client-contracts": "^2.5|^3",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/messenger": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Notifier\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Sends notifications via one or more channels (email, SMS, ...)",
                "homepage": "https://symfony.com",
                "keywords": [
                    "notification",
                    "notifier"
                ],
                "support": {
                    "source": "https://github.com/symfony/notifier/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-12T10:17:15+00:00"
            },
            {
                "name": "symfony/options-resolver",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/options-resolver.git",
                    "reference": "a10f19f5198d589d5c33333cffe98dc9820332dd"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/options-resolver/zipball/a10f19f5198d589d5c33333cffe98dc9820332dd",
                    "reference": "a10f19f5198d589d5c33333cffe98dc9820332dd",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\OptionsResolver\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides an improved replacement for the array_replace PHP function",
                "homepage": "https://symfony.com",
                "keywords": [
                    "config",
                    "configuration",
                    "options"
                ],
                "support": {
                    "source": "https://github.com/symfony/options-resolver/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-12T14:21:09+00:00"
            },
            {
                "name": "symfony/password-hasher",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/password-hasher.git",
                    "reference": "d23ad221989e6b8278d050cabfd7b569eee84590"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/password-hasher/zipball/d23ad221989e6b8278d050cabfd7b569eee84590",
                    "reference": "d23ad221989e6b8278d050cabfd7b569eee84590",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "conflict": {
                    "symfony/security-core": "<5.4"
                },
                "require-dev": {
                    "symfony/console": "^5.4|^6.0",
                    "symfony/security-core": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\PasswordHasher\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Robin Chalas",
                        "email": "robin.chalas@gmail.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides password hashing utilities",
                "homepage": "https://symfony.com",
                "keywords": [
                    "hashing",
                    "password"
                ],
                "support": {
                    "source": "https://github.com/symfony/password-hasher/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-02-14T09:04:20+00:00"
            },
            {
                "name": "symfony/polyfill-intl-grapheme",
                "version": "v1.27.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/polyfill-intl-grapheme.git",
                    "reference": "511a08c03c1960e08a883f4cffcacd219b758354"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/polyfill-intl-grapheme/zipball/511a08c03c1960e08a883f4cffcacd219b758354",
                    "reference": "511a08c03c1960e08a883f4cffcacd219b758354",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1"
                },
                "suggest": {
                    "ext-intl": "For best performance"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "1.27-dev"
                    },
                    "thanks": {
                        "name": "symfony/polyfill",
                        "url": "https://github.com/symfony/polyfill"
                    }
                },
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ],
                    "psr-4": {
                        "Symfony\\Polyfill\\Intl\\Grapheme\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony polyfill for intl's grapheme_* functions",
                "homepage": "https://symfony.com",
                "keywords": [
                    "compatibility",
                    "grapheme",
                    "intl",
                    "polyfill",
                    "portable",
                    "shim"
                ],
                "support": {
                    "source": "https://github.com/symfony/polyfill-intl-grapheme/tree/v1.27.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-11-03T14:55:06+00:00"
            },
            {
                "name": "symfony/polyfill-intl-icu",
                "version": "v1.27.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/polyfill-intl-icu.git",
                    "reference": "a3d9148e2c363588e05abbdd4ee4f971f0a5330c"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/polyfill-intl-icu/zipball/a3d9148e2c363588e05abbdd4ee4f971f0a5330c",
                    "reference": "a3d9148e2c363588e05abbdd4ee4f971f0a5330c",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1"
                },
                "suggest": {
                    "ext-intl": "For best performance and support of other locales than \"en\""
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "1.27-dev"
                    },
                    "thanks": {
                        "name": "symfony/polyfill",
                        "url": "https://github.com/symfony/polyfill"
                    }
                },
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ],
                    "psr-4": {
                        "Symfony\\Polyfill\\Intl\\Icu\\": ""
                    },
                    "classmap": [
                        "Resources/stubs"
                    ],
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony polyfill for intl's ICU-related data and classes",
                "homepage": "https://symfony.com",
                "keywords": [
                    "compatibility",
                    "icu",
                    "intl",
                    "polyfill",
                    "portable",
                    "shim"
                ],
                "support": {
                    "source": "https://github.com/symfony/polyfill-intl-icu/tree/v1.27.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-11-03T14:55:06+00:00"
            },
            {
                "name": "symfony/polyfill-intl-idn",
                "version": "v1.27.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/polyfill-intl-idn.git",
                    "reference": "639084e360537a19f9ee352433b84ce831f3d2da"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/polyfill-intl-idn/zipball/639084e360537a19f9ee352433b84ce831f3d2da",
                    "reference": "639084e360537a19f9ee352433b84ce831f3d2da",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1",
                    "symfony/polyfill-intl-normalizer": "^1.10",
                    "symfony/polyfill-php72": "^1.10"
                },
                "suggest": {
                    "ext-intl": "For best performance"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "1.27-dev"
                    },
                    "thanks": {
                        "name": "symfony/polyfill",
                        "url": "https://github.com/symfony/polyfill"
                    }
                },
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ],
                    "psr-4": {
                        "Symfony\\Polyfill\\Intl\\Idn\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Laurent Bassin",
                        "email": "laurent@bassin.info"
                    },
                    {
                        "name": "Trevor Rowbotham",
                        "email": "trevor.rowbotham@pm.me"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony polyfill for intl's idn_to_ascii and idn_to_utf8 functions",
                "homepage": "https://symfony.com",
                "keywords": [
                    "compatibility",
                    "idn",
                    "intl",
                    "polyfill",
                    "portable",
                    "shim"
                ],
                "support": {
                    "source": "https://github.com/symfony/polyfill-intl-idn/tree/v1.27.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-11-03T14:55:06+00:00"
            },
            {
                "name": "symfony/polyfill-intl-normalizer",
                "version": "v1.27.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/polyfill-intl-normalizer.git",
                    "reference": "19bd1e4fcd5b91116f14d8533c57831ed00571b6"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/polyfill-intl-normalizer/zipball/19bd1e4fcd5b91116f14d8533c57831ed00571b6",
                    "reference": "19bd1e4fcd5b91116f14d8533c57831ed00571b6",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1"
                },
                "suggest": {
                    "ext-intl": "For best performance"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "1.27-dev"
                    },
                    "thanks": {
                        "name": "symfony/polyfill",
                        "url": "https://github.com/symfony/polyfill"
                    }
                },
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ],
                    "psr-4": {
                        "Symfony\\Polyfill\\Intl\\Normalizer\\": ""
                    },
                    "classmap": [
                        "Resources/stubs"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony polyfill for intl's Normalizer class and related functions",
                "homepage": "https://symfony.com",
                "keywords": [
                    "compatibility",
                    "intl",
                    "normalizer",
                    "polyfill",
                    "portable",
                    "shim"
                ],
                "support": {
                    "source": "https://github.com/symfony/polyfill-intl-normalizer/tree/v1.27.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-11-03T14:55:06+00:00"
            },
            {
                "name": "symfony/polyfill-mbstring",
                "version": "v1.27.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/polyfill-mbstring.git",
                    "reference": "8ad114f6b39e2c98a8b0e3bd907732c207c2b534"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/polyfill-mbstring/zipball/8ad114f6b39e2c98a8b0e3bd907732c207c2b534",
                    "reference": "8ad114f6b39e2c98a8b0e3bd907732c207c2b534",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1"
                },
                "provide": {
                    "ext-mbstring": "*"
                },
                "suggest": {
                    "ext-mbstring": "For best performance"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "1.27-dev"
                    },
                    "thanks": {
                        "name": "symfony/polyfill",
                        "url": "https://github.com/symfony/polyfill"
                    }
                },
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ],
                    "psr-4": {
                        "Symfony\\Polyfill\\Mbstring\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony polyfill for the Mbstring extension",
                "homepage": "https://symfony.com",
                "keywords": [
                    "compatibility",
                    "mbstring",
                    "polyfill",
                    "portable",
                    "shim"
                ],
                "support": {
                    "source": "https://github.com/symfony/polyfill-mbstring/tree/v1.27.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-11-03T14:55:06+00:00"
            },
            {
                "name": "symfony/polyfill-php83",
                "version": "v1.27.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/polyfill-php83.git",
                    "reference": "508c652ba3ccf69f8c97f251534f229791b52a57"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/polyfill-php83/zipball/508c652ba3ccf69f8c97f251534f229791b52a57",
                    "reference": "508c652ba3ccf69f8c97f251534f229791b52a57",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1",
                    "symfony/polyfill-php80": "^1.14"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "1.27-dev"
                    },
                    "thanks": {
                        "name": "symfony/polyfill",
                        "url": "https://github.com/symfony/polyfill"
                    }
                },
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ],
                    "psr-4": {
                        "Symfony\\Polyfill\\Php83\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony polyfill backporting some PHP 8.3+ features to lower PHP versions",
                "homepage": "https://symfony.com",
                "keywords": [
                    "compatibility",
                    "polyfill",
                    "portable",
                    "shim"
                ],
                "support": {
                    "source": "https://github.com/symfony/polyfill-php83/tree/v1.27.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2022-11-03T14:55:06+00:00"
            },
            {
                "name": "symfony/process",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/process.git",
                    "reference": "c5ce962db0d9b6e80247ca5eb9af6472bd4d7b5d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/process/zipball/c5ce962db0d9b6e80247ca5eb9af6472bd4d7b5d",
                    "reference": "c5ce962db0d9b6e80247ca5eb9af6472bd4d7b5d",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Process\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Executes commands in sub-processes",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/process/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-12T16:00:22+00:00"
            },
            {
                "name": "symfony/property-access",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/property-access.git",
                    "reference": "2dc4f9da444b8f8ff592e95d570caad67924f1d0"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/property-access/zipball/2dc4f9da444b8f8ff592e95d570caad67924f1d0",
                    "reference": "2dc4f9da444b8f8ff592e95d570caad67924f1d0",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/property-info": "^5.4|^6.0"
                },
                "require-dev": {
                    "symfony/cache": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\PropertyAccess\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides functions to read and write from/to an object or array using a simple string notation",
                "homepage": "https://symfony.com",
                "keywords": [
                    "access",
                    "array",
                    "extraction",
                    "index",
                    "injection",
                    "object",
                    "property",
                    "property-path",
                    "reflection"
                ],
                "support": {
                    "source": "https://github.com/symfony/property-access/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-13T15:26:11+00:00"
            },
            {
                "name": "symfony/property-info",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/property-info.git",
                    "reference": "7f3a03716112269741fe2a809f8f791a371d1fcd"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/property-info/zipball/7f3a03716112269741fe2a809f8f791a371d1fcd",
                    "reference": "7f3a03716112269741fe2a809f8f791a371d1fcd",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/string": "^5.4|^6.0"
                },
                "conflict": {
                    "phpdocumentor/reflection-docblock": "<5.2",
                    "phpdocumentor/type-resolver": "<1.5.1",
                    "symfony/dependency-injection": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.10.4|^2",
                    "phpdocumentor/reflection-docblock": "^5.2",
                    "phpstan/phpdoc-parser": "^1.0",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/serializer": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\PropertyInfo\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Kévin Dunglas",
                        "email": "dunglas@gmail.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Extracts information about PHP class' properties using metadata of popular sources",
                "homepage": "https://symfony.com",
                "keywords": [
                    "doctrine",
                    "phpdoc",
                    "property",
                    "symfony",
                    "type",
                    "validator"
                ],
                "support": {
                    "source": "https://github.com/symfony/property-info/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-19T08:06:44+00:00"
            },
            {
                "name": "symfony/routing",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/routing.git",
                    "reference": "e7243039ab663822ff134fbc46099b5fdfa16f6a"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/routing/zipball/e7243039ab663822ff134fbc46099b5fdfa16f6a",
                    "reference": "e7243039ab663822ff134fbc46099b5fdfa16f6a",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3"
                },
                "conflict": {
                    "doctrine/annotations": "<1.12",
                    "symfony/config": "<6.2",
                    "symfony/dependency-injection": "<5.4",
                    "symfony/yaml": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.12|^2",
                    "psr/log": "^1|^2|^3",
                    "symfony/config": "^6.2",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Routing\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Maps an HTTP request to a set of configuration variables",
                "homepage": "https://symfony.com",
                "keywords": [
                    "router",
                    "routing",
                    "uri",
                    "url"
                ],
                "support": {
                    "source": "https://github.com/symfony/routing/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/runtime",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/runtime.git",
                    "reference": "d5c09493647a0c1a16e6c8da308098e840d1164f"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/runtime/zipball/d5c09493647a0c1a16e6c8da308098e840d1164f",
                    "reference": "d5c09493647a0c1a16e6c8da308098e840d1164f",
                    "shasum": ""
                },
                "require": {
                    "composer-plugin-api": "^1.0|^2.0",
                    "php": ">=8.1"
                },
                "conflict": {
                    "symfony/dotenv": "<5.4"
                },
                "require-dev": {
                    "composer/composer": "^1.0.2|^2.0",
                    "symfony/console": "^5.4.9|^6.0.9",
                    "symfony/dotenv": "^5.4|^6.0",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0"
                },
                "type": "composer-plugin",
                "extra": {
                    "class": "Symfony\\Component\\Runtime\\Internal\\ComposerPlugin"
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Runtime\\": "",
                        "Symfony\\Runtime\\Symfony\\Component\\": "Internal/"
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Enables decoupling PHP applications from global state",
                "homepage": "https://symfony.com",
                "keywords": [
                    "runtime"
                ],
                "support": {
                    "source": "https://github.com/symfony/runtime/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-16T17:05:46+00:00"
            },
            {
                "name": "symfony/security-bundle",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/security-bundle.git",
                    "reference": "b33382ca3034ee691dd0d882f214ae9e037f4427"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/security-bundle/zipball/b33382ca3034ee691dd0d882f214ae9e037f4427",
                    "reference": "b33382ca3034ee691dd0d882f214ae9e037f4427",
                    "shasum": ""
                },
                "require": {
                    "composer-runtime-api": ">=2.1",
                    "ext-xml": "*",
                    "php": ">=8.1",
                    "symfony/clock": "^6.3",
                    "symfony/config": "^6.1",
                    "symfony/dependency-injection": "^6.2",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/http-foundation": "^6.2",
                    "symfony/http-kernel": "^6.2",
                    "symfony/password-hasher": "^5.4|^6.0",
                    "symfony/security-core": "^6.2",
                    "symfony/security-csrf": "^5.4|^6.0",
                    "symfony/security-http": "^6.3"
                },
                "conflict": {
                    "symfony/browser-kit": "<5.4",
                    "symfony/console": "<5.4",
                    "symfony/framework-bundle": "<6.3",
                    "symfony/http-client": "<5.4",
                    "symfony/ldap": "<5.4",
                    "symfony/twig-bundle": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.10.4|^2",
                    "symfony/asset": "^5.4|^6.0",
                    "symfony/browser-kit": "^5.4|^6.0",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/css-selector": "^5.4|^6.0",
                    "symfony/dom-crawler": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/form": "^5.4|^6.0",
                    "symfony/framework-bundle": "^6.3",
                    "symfony/http-client": "^5.4|^6.0",
                    "symfony/ldap": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0",
                    "symfony/rate-limiter": "^5.4|^6.0",
                    "symfony/serializer": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "symfony/twig-bridge": "^5.4|^6.0",
                    "symfony/twig-bundle": "^5.4|^6.0",
                    "symfony/validator": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0",
                    "twig/twig": "^2.13|^3.0.4",
                    "web-token/jwt-checker": "^3.1",
                    "web-token/jwt-signature-algorithm-ecdsa": "^3.1",
                    "web-token/jwt-signature-algorithm-eddsa": "^3.1",
                    "web-token/jwt-signature-algorithm-hmac": "^3.1",
                    "web-token/jwt-signature-algorithm-none": "^3.1",
                    "web-token/jwt-signature-algorithm-rsa": "^3.1"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bundle\\SecurityBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides a tight integration of the Security component into the Symfony full-stack framework",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/security-bundle/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/security-core",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/security-core.git",
                    "reference": "b86ce012cc9a62a15ed43af5037eebc3e6de4d7f"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/security-core/zipball/b86ce012cc9a62a15ed43af5037eebc3e6de4d7f",
                    "reference": "b86ce012cc9a62a15ed43af5037eebc3e6de4d7f",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/event-dispatcher-contracts": "^2.5|^3",
                    "symfony/password-hasher": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "conflict": {
                    "symfony/event-dispatcher": "<5.4",
                    "symfony/http-foundation": "<5.4",
                    "symfony/ldap": "<5.4",
                    "symfony/security-guard": "<5.4",
                    "symfony/validator": "<5.4"
                },
                "require-dev": {
                    "psr/cache": "^1.0|^2.0|^3.0",
                    "psr/container": "^1.1|^2.0",
                    "psr/log": "^1|^2|^3",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/event-dispatcher": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/ldap": "^5.4|^6.0",
                    "symfony/string": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "symfony/validator": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Security\\Core\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony Security Component - Core Library",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/security-core/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/security-csrf",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/security-csrf.git",
                    "reference": "63d7b098c448cbddb46ea5eda33b68c1ece6eb5b"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/security-csrf/zipball/63d7b098c448cbddb46ea5eda33b68c1ece6eb5b",
                    "reference": "63d7b098c448cbddb46ea5eda33b68c1ece6eb5b",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/security-core": "^5.4|^6.0"
                },
                "conflict": {
                    "symfony/http-foundation": "<5.4"
                },
                "require-dev": {
                    "symfony/http-foundation": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Security\\Csrf\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony Security Component - CSRF Library",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/security-csrf/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-05T08:41:27+00:00"
            },
            {
                "name": "symfony/security-http",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/security-http.git",
                    "reference": "04d6b868786a56c1fadc52b003fe5a4f9ab3f3d0"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/security-http/zipball/04d6b868786a56c1fadc52b003fe5a4f9ab3f3d0",
                    "reference": "04d6b868786a56c1fadc52b003fe5a4f9ab3f3d0",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^6.3",
                    "symfony/polyfill-mbstring": "~1.0",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/security-core": "^6.3"
                },
                "conflict": {
                    "symfony/clock": "<6.3",
                    "symfony/event-dispatcher": "<5.4.9|>=6,<6.0.9",
                    "symfony/http-client-contracts": "<3.0",
                    "symfony/security-bundle": "<5.4",
                    "symfony/security-csrf": "<5.4"
                },
                "require-dev": {
                    "psr/log": "^1|^2|^3",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/clock": "^6.3",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/http-client-contracts": "^3.0",
                    "symfony/rate-limiter": "^5.4|^6.0",
                    "symfony/routing": "^5.4|^6.0",
                    "symfony/security-csrf": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "web-token/jwt-checker": "^3.1",
                    "web-token/jwt-signature-algorithm-ecdsa": "^3.1"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Security\\Http\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony Security Component - HTTP Integration",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/security-http/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-13T14:29:38+00:00"
            },
            {
                "name": "symfony/serializer",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/serializer.git",
                    "reference": "33deb86d212893042d7758d452aa39d19ca0efe3"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/serializer/zipball/33deb86d212893042d7758d452aa39d19ca0efe3",
                    "reference": "33deb86d212893042d7758d452aa39d19ca0efe3",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-ctype": "~1.8"
                },
                "conflict": {
                    "doctrine/annotations": "<1.12",
                    "phpdocumentor/reflection-docblock": "<3.2.2",
                    "phpdocumentor/type-resolver": "<1.4.0",
                    "symfony/dependency-injection": "<5.4",
                    "symfony/property-access": "<5.4",
                    "symfony/property-info": "<5.4.24|>=6,<6.2.11",
                    "symfony/uid": "<5.4",
                    "symfony/yaml": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.12|^2",
                    "phpdocumentor/reflection-docblock": "^3.2|^4.0|^5.0",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/error-handler": "^5.4|^6.0",
                    "symfony/filesystem": "^5.4|^6.0",
                    "symfony/form": "^5.4|^6.0",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/mime": "^5.4|^6.0",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/property-info": "^5.4.24|^6.2.11",
                    "symfony/uid": "^5.4|^6.0",
                    "symfony/validator": "^5.4|^6.0",
                    "symfony/var-dumper": "^5.4|^6.0",
                    "symfony/var-exporter": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Serializer\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Handles serializing and deserializing data structures, including object graphs, into array structures or other formats like XML and JSON.",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/serializer/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/service-contracts",
                "version": "v3.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/service-contracts.git",
                    "reference": "40da9cc13ec349d9e4966ce18b5fbcd724ab10a4"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/service-contracts/zipball/40da9cc13ec349d9e4966ce18b5fbcd724ab10a4",
                    "reference": "40da9cc13ec349d9e4966ce18b5fbcd724ab10a4",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/container": "^2.0"
                },
                "conflict": {
                    "ext-psr": "<1.1|>=2"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.4-dev"
                    },
                    "thanks": {
                        "name": "symfony/contracts",
                        "url": "https://github.com/symfony/contracts"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Contracts\\Service\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Test/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Generic abstractions related to writing services",
                "homepage": "https://symfony.com",
                "keywords": [
                    "abstractions",
                    "contracts",
                    "decoupling",
                    "interfaces",
                    "interoperability",
                    "standards"
                ],
                "support": {
                    "source": "https://github.com/symfony/service-contracts/tree/v3.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-23T14:45:45+00:00"
            },
            {
                "name": "symfony/stopwatch",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/stopwatch.git",
                    "reference": "fc47f1015ec80927ff64ba9094dfe8b9d48fe9f2"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/stopwatch/zipball/fc47f1015ec80927ff64ba9094dfe8b9d48fe9f2",
                    "reference": "fc47f1015ec80927ff64ba9094dfe8b9d48fe9f2",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/service-contracts": "^2.5|^3"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Stopwatch\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides a way to profile code",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/stopwatch/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-02-16T10:14:28+00:00"
            },
            {
                "name": "symfony/string",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/string.git",
                    "reference": "53d1a83225002635bca3482fcbf963001313fb68"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/string/zipball/53d1a83225002635bca3482fcbf963001313fb68",
                    "reference": "53d1a83225002635bca3482fcbf963001313fb68",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/polyfill-ctype": "~1.8",
                    "symfony/polyfill-intl-grapheme": "~1.0",
                    "symfony/polyfill-intl-normalizer": "~1.0",
                    "symfony/polyfill-mbstring": "~1.0"
                },
                "conflict": {
                    "symfony/translation-contracts": "<2.5"
                },
                "require-dev": {
                    "symfony/error-handler": "^5.4|^6.0",
                    "symfony/http-client": "^5.4|^6.0",
                    "symfony/intl": "^6.2",
                    "symfony/translation-contracts": "^2.5|^3.0",
                    "symfony/var-exporter": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "files": [
                        "Resources/functions.php"
                    ],
                    "psr-4": {
                        "Symfony\\Component\\String\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides an object-oriented API to strings and deals with bytes, UTF-8 code points and grapheme clusters in a unified way",
                "homepage": "https://symfony.com",
                "keywords": [
                    "grapheme",
                    "i18n",
                    "string",
                    "unicode",
                    "utf-8",
                    "utf8"
                ],
                "support": {
                    "source": "https://github.com/symfony/string/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-05T08:41:27+00:00"
            },
            {
                "name": "symfony/translation",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/translation.git",
                    "reference": "3ed078c54bc98bbe4414e1e9b2d5e85ed5a5c8bd"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/translation/zipball/3ed078c54bc98bbe4414e1e9b2d5e85ed5a5c8bd",
                    "reference": "3ed078c54bc98bbe4414e1e9b2d5e85ed5a5c8bd",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-mbstring": "~1.0",
                    "symfony/translation-contracts": "^2.5|^3.0"
                },
                "conflict": {
                    "symfony/config": "<5.4",
                    "symfony/console": "<5.4",
                    "symfony/dependency-injection": "<5.4",
                    "symfony/http-client-contracts": "<2.5",
                    "symfony/http-kernel": "<5.4",
                    "symfony/service-contracts": "<2.5",
                    "symfony/twig-bundle": "<5.4",
                    "symfony/yaml": "<5.4"
                },
                "provide": {
                    "symfony/translation-implementation": "2.3|3.0"
                },
                "require-dev": {
                    "nikic/php-parser": "^4.13",
                    "psr/log": "^1|^2|^3",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/http-client-contracts": "^2.5|^3.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/intl": "^5.4|^6.0",
                    "symfony/polyfill-intl-icu": "^1.21",
                    "symfony/routing": "^5.4|^6.0",
                    "symfony/service-contracts": "^2.5|^3",
                    "symfony/yaml": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "files": [
                        "Resources/functions.php"
                    ],
                    "psr-4": {
                        "Symfony\\Component\\Translation\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides tools to internationalize your application",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/translation/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/translation-contracts",
                "version": "v3.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/translation-contracts.git",
                    "reference": "02c24deb352fb0d79db5486c0c79905a85e37e86"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/translation-contracts/zipball/02c24deb352fb0d79db5486c0c79905a85e37e86",
                    "reference": "02c24deb352fb0d79db5486c0c79905a85e37e86",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-main": "3.4-dev"
                    },
                    "thanks": {
                        "name": "symfony/contracts",
                        "url": "https://github.com/symfony/contracts"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Contracts\\Translation\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Test/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Generic abstractions related to translation",
                "homepage": "https://symfony.com",
                "keywords": [
                    "abstractions",
                    "contracts",
                    "decoupling",
                    "interfaces",
                    "interoperability",
                    "standards"
                ],
                "support": {
                    "source": "https://github.com/symfony/translation-contracts/tree/v3.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-30T17:17:10+00:00"
            },
            {
                "name": "symfony/twig-bridge",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/twig-bridge.git",
                    "reference": "6f8435db76a2d79917489a19a82679276c1b4e32"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/twig-bridge/zipball/6f8435db76a2d79917489a19a82679276c1b4e32",
                    "reference": "6f8435db76a2d79917489a19a82679276c1b4e32",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/translation-contracts": "^2.5|^3",
                    "twig/twig": "^2.13|^3.0.4"
                },
                "conflict": {
                    "phpdocumentor/reflection-docblock": "<3.2.2",
                    "phpdocumentor/type-resolver": "<1.4.0",
                    "symfony/console": "<5.4",
                    "symfony/form": "<6.3",
                    "symfony/http-foundation": "<5.4",
                    "symfony/http-kernel": "<6.2",
                    "symfony/mime": "<6.2",
                    "symfony/translation": "<5.4",
                    "symfony/workflow": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.12|^2",
                    "egulias/email-validator": "^2.1.10|^3|^4",
                    "league/html-to-markdown": "^5.0",
                    "phpdocumentor/reflection-docblock": "^3.0|^4.0|^5.0",
                    "symfony/asset": "^5.4|^6.0",
                    "symfony/asset-mapper": "^6.3",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/form": "^6.3",
                    "symfony/html-sanitizer": "^6.1",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^6.2",
                    "symfony/intl": "^5.4|^6.0",
                    "symfony/mime": "^6.2",
                    "symfony/polyfill-intl-icu": "~1.0",
                    "symfony/property-info": "^5.4|^6.0",
                    "symfony/routing": "^5.4|^6.0",
                    "symfony/security-acl": "^2.8|^3.0",
                    "symfony/security-core": "^5.4|^6.0",
                    "symfony/security-csrf": "^5.4|^6.0",
                    "symfony/security-http": "^5.4|^6.0",
                    "symfony/serializer": "^6.2",
                    "symfony/stopwatch": "^5.4|^6.0",
                    "symfony/translation": "^6.1",
                    "symfony/web-link": "^5.4|^6.0",
                    "symfony/workflow": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0",
                    "twig/cssinliner-extra": "^2.12|^3",
                    "twig/inky-extra": "^2.12|^3",
                    "twig/markdown-extra": "^2.12|^3"
                },
                "type": "symfony-bridge",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bridge\\Twig\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides integration for Twig with various Symfony components",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/twig-bridge/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-20T16:42:33+00:00"
            },
            {
                "name": "symfony/twig-bundle",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/twig-bundle.git",
                    "reference": "d0cd4d1675c0582d27c2e8bb0dc27c0303d8e3ea"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/twig-bundle/zipball/d0cd4d1675c0582d27c2e8bb0dc27c0303d8e3ea",
                    "reference": "d0cd4d1675c0582d27c2e8bb0dc27c0303d8e3ea",
                    "shasum": ""
                },
                "require": {
                    "composer-runtime-api": ">=2.1",
                    "php": ">=8.1",
                    "symfony/config": "^6.1",
                    "symfony/dependency-injection": "^6.1",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^6.2",
                    "symfony/twig-bridge": "^6.3",
                    "twig/twig": "^2.13|^3.0.4"
                },
                "conflict": {
                    "symfony/framework-bundle": "<5.4",
                    "symfony/translation": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.10.4|^2",
                    "symfony/asset": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/form": "^5.4|^6.0",
                    "symfony/framework-bundle": "^5.4|^6.0",
                    "symfony/routing": "^5.4|^6.0",
                    "symfony/stopwatch": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "symfony/web-link": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bundle\\TwigBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides a tight integration of Twig into the Symfony full-stack framework",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/twig-bundle/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-06T09:53:41+00:00"
            },
            {
                "name": "symfony/validator",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/validator.git",
                    "reference": "b0c4ecf17d39eee1edfecc92299a03b9f5d5220b"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/validator/zipball/b0c4ecf17d39eee1edfecc92299a03b9f5d5220b",
                    "reference": "b0c4ecf17d39eee1edfecc92299a03b9f5d5220b",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-ctype": "~1.8",
                    "symfony/polyfill-mbstring": "~1.0",
                    "symfony/polyfill-php83": "^1.27",
                    "symfony/translation-contracts": "^2.5|^3"
                },
                "conflict": {
                    "doctrine/annotations": "<1.13",
                    "doctrine/lexer": "<1.1",
                    "symfony/dependency-injection": "<5.4",
                    "symfony/expression-language": "<5.4",
                    "symfony/http-kernel": "<5.4",
                    "symfony/intl": "<5.4",
                    "symfony/property-info": "<5.4",
                    "symfony/translation": "<5.4",
                    "symfony/yaml": "<5.4"
                },
                "require-dev": {
                    "doctrine/annotations": "^1.13|^2",
                    "egulias/email-validator": "^2.1.10|^3|^4",
                    "symfony/cache": "^5.4|^6.0",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/expression-language": "^5.4|^6.0",
                    "symfony/finder": "^5.4|^6.0",
                    "symfony/http-client": "^5.4|^6.0",
                    "symfony/http-foundation": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/intl": "^5.4|^6.0",
                    "symfony/mime": "^5.4|^6.0",
                    "symfony/property-access": "^5.4|^6.0",
                    "symfony/property-info": "^5.4|^6.0",
                    "symfony/translation": "^5.4|^6.0",
                    "symfony/yaml": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Validator\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides tools to validate values",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/validator/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-26T17:39:03+00:00"
            },
            {
                "name": "symfony/var-dumper",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/var-dumper.git",
                    "reference": "77fb4f2927f6991a9843633925d111147449ee7a"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/var-dumper/zipball/77fb4f2927f6991a9843633925d111147449ee7a",
                    "reference": "77fb4f2927f6991a9843633925d111147449ee7a",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-mbstring": "~1.0"
                },
                "conflict": {
                    "symfony/console": "<5.4"
                },
                "require-dev": {
                    "ext-iconv": "*",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0",
                    "symfony/uid": "^5.4|^6.0",
                    "twig/twig": "^2.13|^3.0.4"
                },
                "bin": [
                    "Resources/bin/var-dump-server"
                ],
                "type": "library",
                "autoload": {
                    "files": [
                        "Resources/functions/dump.php"
                    ],
                    "psr-4": {
                        "Symfony\\Component\\VarDumper\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides mechanisms for walking through any arbitrary PHP variable",
                "homepage": "https://symfony.com",
                "keywords": [
                    "debug",
                    "dump"
                ],
                "support": {
                    "source": "https://github.com/symfony/var-dumper/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfony/var-exporter",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/var-exporter.git",
                    "reference": "3400949782c0cb5b3e73aa64cfd71dde000beccc"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/var-exporter/zipball/3400949782c0cb5b3e73aa64cfd71dde000beccc",
                    "reference": "3400949782c0cb5b3e73aa64cfd71dde000beccc",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "require-dev": {
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\VarExporter\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Allows exporting any serializable PHP data structure to plain PHP code",
                "homepage": "https://symfony.com",
                "keywords": [
                    "clone",
                    "construct",
                    "export",
                    "hydrate",
                    "instantiate",
                    "lazy-loading",
                    "proxy",
                    "serialize"
                ],
                "support": {
                    "source": "https://github.com/symfony/var-exporter/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-26T17:39:03+00:00"
            },
            {
                "name": "symfony/web-link",
                "version": "v6.3.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/web-link.git",
                    "reference": "0989ca617d0703cdca501a245f10e194ff22315b"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/web-link/zipball/0989ca617d0703cdca501a245f10e194ff22315b",
                    "reference": "0989ca617d0703cdca501a245f10e194ff22315b",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "psr/link": "^1.1|^2.0"
                },
                "conflict": {
                    "symfony/http-kernel": "<5.4"
                },
                "provide": {
                    "psr/link-implementation": "1.0|2.0"
                },
                "require-dev": {
                    "symfony/http-kernel": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\WebLink\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Kévin Dunglas",
                        "email": "dunglas@gmail.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Manages links between resources",
                "homepage": "https://symfony.com",
                "keywords": [
                    "dns-prefetch",
                    "http",
                    "http2",
                    "link",
                    "performance",
                    "prefetch",
                    "preload",
                    "prerender",
                    "psr13",
                    "push"
                ],
                "support": {
                    "source": "https://github.com/symfony/web-link/tree/v6.3.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-04-21T14:41:17+00:00"
            },
            {
                "name": "symfony/yaml",
                "version": "v6.3.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/yaml.git",
                    "reference": "e23292e8c07c85b971b44c1c4b87af52133e2add"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/yaml/zipball/e23292e8c07c85b971b44c1c4b87af52133e2add",
                    "reference": "e23292e8c07c85b971b44c1c4b87af52133e2add",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/deprecation-contracts": "^2.5|^3",
                    "symfony/polyfill-ctype": "^1.8"
                },
                "conflict": {
                    "symfony/console": "<5.4"
                },
                "require-dev": {
                    "symfony/console": "^5.4|^6.0"
                },
                "bin": [
                    "Resources/bin/yaml-lint"
                ],
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\Yaml\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Loads and dumps YAML files",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/yaml/tree/v6.3.3"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-31T07:08:24+00:00"
            },
            {
                "name": "symfonycasts/verify-email-bundle",
                "version": "v1.13.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/SymfonyCasts/verify-email-bundle.git",
                    "reference": "eb7bc997f36ad872a0d56bf209fe37fed148b0a7"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/SymfonyCasts/verify-email-bundle/zipball/eb7bc997f36ad872a0d56bf209fe37fed148b0a7",
                    "reference": "eb7bc997f36ad872a0d56bf209fe37fed148b0a7",
                    "shasum": ""
                },
                "require": {
                    "ext-json": "*",
                    "php": ">=7.2.5",
                    "symfony/config": "^5.4 | ^6.0",
                    "symfony/dependency-injection": "^5.4 | ^6.0",
                    "symfony/deprecation-contracts": "^2.2 | ^3.0",
                    "symfony/http-kernel": "^5.4 | ^6.0",
                    "symfony/routing": "^5.4 | ^6.0"
                },
                "require-dev": {
                    "doctrine/orm": "^2.7",
                    "doctrine/persistence": "^2.0",
                    "symfony/framework-bundle": "^5.4 | ^6.0",
                    "symfony/phpunit-bridge": "^5.4 | ^6.0",
                    "vimeo/psalm": "^4.3"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "SymfonyCasts\\Bundle\\VerifyEmail\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "description": "Simple, stylish Email Verification for Symfony",
                "support": {
                    "issues": "https://github.com/SymfonyCasts/verify-email-bundle/issues",
                    "source": "https://github.com/SymfonyCasts/verify-email-bundle/tree/v1.13.0"
                },
                "time": "2023-01-04T12:46:15+00:00"
            },
            {
                "name": "twig/extra-bundle",
                "version": "v3.7.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/twigphp/twig-extra-bundle.git",
                    "reference": "802cc2dd46ec88285d6c7fa85c26ab7f2cd5bc49"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/twigphp/twig-extra-bundle/zipball/802cc2dd46ec88285d6c7fa85c26ab7f2cd5bc49",
                    "reference": "802cc2dd46ec88285d6c7fa85c26ab7f2cd5bc49",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.2.5",
                    "symfony/framework-bundle": "^4.4|^5.0|^6.0",
                    "symfony/twig-bundle": "^4.4|^5.0|^6.0",
                    "twig/twig": "^2.7|^3.0"
                },
                "require-dev": {
                    "league/commonmark": "^1.0|^2.0",
                    "symfony/phpunit-bridge": "^4.4.9|^5.0.9|^6.0",
                    "twig/cache-extra": "^3.0",
                    "twig/cssinliner-extra": "^2.12|^3.0",
                    "twig/html-extra": "^2.12|^3.0",
                    "twig/inky-extra": "^2.12|^3.0",
                    "twig/intl-extra": "^2.12|^3.0",
                    "twig/markdown-extra": "^2.12|^3.0",
                    "twig/string-extra": "^2.12|^3.0"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Twig\\Extra\\TwigExtraBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com",
                        "homepage": "http://fabien.potencier.org",
                        "role": "Lead Developer"
                    }
                ],
                "description": "A Symfony bundle for extra Twig extensions",
                "homepage": "https://twig.symfony.com",
                "keywords": [
                    "bundle",
                    "extra",
                    "twig"
                ],
                "support": {
                    "source": "https://github.com/twigphp/twig-extra-bundle/tree/v3.7.0"
                },
                "funding": [
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/twig/twig",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-06T11:11:46+00:00"
            },
            {
                "name": "twig/twig",
                "version": "v3.7.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/twigphp/Twig.git",
                    "reference": "5cf942bbab3df42afa918caeba947f1b690af64b"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/twigphp/Twig/zipball/5cf942bbab3df42afa918caeba947f1b690af64b",
                    "reference": "5cf942bbab3df42afa918caeba947f1b690af64b",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.2.5",
                    "symfony/polyfill-ctype": "^1.8",
                    "symfony/polyfill-mbstring": "^1.3"
                },
                "require-dev": {
                    "psr/container": "^1.0|^2.0",
                    "symfony/phpunit-bridge": "^4.4.9|^5.0.9|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Twig\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com",
                        "homepage": "http://fabien.potencier.org",
                        "role": "Lead Developer"
                    },
                    {
                        "name": "Twig Team",
                        "role": "Contributors"
                    },
                    {
                        "name": "Armin Ronacher",
                        "email": "armin.ronacher@active-4.com",
                        "role": "Project Founder"
                    }
                ],
                "description": "Twig, the flexible, fast, and secure template language for PHP",
                "homepage": "https://twig.symfony.com",
                "keywords": [
                    "templating"
                ],
                "support": {
                    "issues": "https://github.com/twigphp/Twig/issues",
                    "source": "https://github.com/twigphp/Twig/tree/v3.7.0"
                },
                "funding": [
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/twig/twig",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-26T07:16:09+00:00"
            },
            {
                "name": "webmozart/assert",
                "version": "1.11.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/webmozarts/assert.git",
                    "reference": "11cb2199493b2f8a3b53e7f19068fc6aac760991"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/webmozarts/assert/zipball/11cb2199493b2f8a3b53e7f19068fc6aac760991",
                    "reference": "11cb2199493b2f8a3b53e7f19068fc6aac760991",
                    "shasum": ""
                },
                "require": {
                    "ext-ctype": "*",
                    "php": "^7.2 || ^8.0"
                },
                "conflict": {
                    "phpstan/phpstan": "<0.12.20",
                    "vimeo/psalm": "<4.6.1 || 4.6.2"
                },
                "require-dev": {
                    "phpunit/phpunit": "^8.5.13"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.10-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Webmozart\\Assert\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Bernhard Schussek",
                        "email": "bschussek@gmail.com"
                    }
                ],
                "description": "Assertions to validate method input/output with nice error messages.",
                "keywords": [
                    "assert",
                    "check",
                    "validate"
                ],
                "support": {
                    "issues": "https://github.com/webmozarts/assert/issues",
                    "source": "https://github.com/webmozarts/assert/tree/1.11.0"
                },
                "time": "2022-06-03T18:03:27+00:00"
            },
            {
                "name": "willdurand/negotiation",
                "version": "3.1.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/willdurand/Negotiation.git",
                    "reference": "68e9ea0553ef6e2ee8db5c1d98829f111e623ec2"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/willdurand/Negotiation/zipball/68e9ea0553ef6e2ee8db5c1d98829f111e623ec2",
                    "reference": "68e9ea0553ef6e2ee8db5c1d98829f111e623ec2",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1.0"
                },
                "require-dev": {
                    "symfony/phpunit-bridge": "^5.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.0-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Negotiation\\": "src/Negotiation"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "William Durand",
                        "email": "will+git@drnd.me"
                    }
                ],
                "description": "Content Negotiation tools for PHP provided as a standalone library.",
                "homepage": "http://williamdurand.fr/Negotiation/",
                "keywords": [
                    "accept",
                    "content",
                    "format",
                    "header",
                    "negotiation"
                ],
                "support": {
                    "issues": "https://github.com/willdurand/Negotiation/issues",
                    "source": "https://github.com/willdurand/Negotiation/tree/3.1.0"
                },
                "time": "2022-01-30T20:08:53+00:00"
            }
        ],
        "packages-dev": [
            {
                "name": "doctrine/data-fixtures",
                "version": "1.6.6",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/data-fixtures.git",
                    "reference": "4af35dadbfcf4b00abb2a217c4c8c8800cf5fcf4"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/data-fixtures/zipball/4af35dadbfcf4b00abb2a217c4c8c8800cf5fcf4",
                    "reference": "4af35dadbfcf4b00abb2a217c4c8c8800cf5fcf4",
                    "shasum": ""
                },
                "require": {
                    "doctrine/deprecations": "^0.5.3 || ^1.0",
                    "doctrine/persistence": "^1.3.3 || ^2.0 || ^3.0",
                    "php": "^7.2 || ^8.0"
                },
                "conflict": {
                    "doctrine/dbal": "<2.13",
                    "doctrine/orm": "<2.12",
                    "doctrine/phpcr-odm": "<1.3.0"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^11.0",
                    "doctrine/dbal": "^2.13 || ^3.0",
                    "doctrine/mongodb-odm": "^1.3.0 || ^2.0.0",
                    "doctrine/orm": "^2.12",
                    "ext-sqlite3": "*",
                    "phpstan/phpstan": "^1.5",
                    "phpunit/phpunit": "^8.5 || ^9.5 || ^10.0",
                    "symfony/cache": "^5.0 || ^6.0",
                    "vimeo/psalm": "^4.10 || ^5.9"
                },
                "suggest": {
                    "alcaeus/mongo-php-adapter": "For using MongoDB ODM 1.3 with PHP 7 (deprecated)",
                    "doctrine/mongodb-odm": "For loading MongoDB ODM fixtures",
                    "doctrine/orm": "For loading ORM fixtures",
                    "doctrine/phpcr-odm": "For loading PHPCR ODM fixtures"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Common\\DataFixtures\\": "src"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Jonathan Wage",
                        "email": "jonwage@gmail.com"
                    }
                ],
                "description": "Data Fixtures for all Doctrine Object Managers",
                "homepage": "https://www.doctrine-project.org",
                "keywords": [
                    "database"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/data-fixtures/issues",
                    "source": "https://github.com/doctrine/data-fixtures/tree/1.6.6"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fdata-fixtures",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-04-20T13:08:54+00:00"
            },
            {
                "name": "doctrine/doctrine-fixtures-bundle",
                "version": "3.4.4",
                "source": {
                    "type": "git",
                    "url": "https://github.com/doctrine/DoctrineFixturesBundle.git",
                    "reference": "9ec3139c52a42e94c9fd1e95f8d2bca94326edfb"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/doctrine/DoctrineFixturesBundle/zipball/9ec3139c52a42e94c9fd1e95f8d2bca94326edfb",
                    "reference": "9ec3139c52a42e94c9fd1e95f8d2bca94326edfb",
                    "shasum": ""
                },
                "require": {
                    "doctrine/data-fixtures": "^1.3",
                    "doctrine/doctrine-bundle": "^1.11|^2.0",
                    "doctrine/orm": "^2.6.0",
                    "doctrine/persistence": "^1.3.7|^2.0|^3.0",
                    "php": "^7.1 || ^8.0",
                    "symfony/config": "^3.4|^4.3|^5.0|^6.0",
                    "symfony/console": "^3.4|^4.3|^5.0|^6.0",
                    "symfony/dependency-injection": "^3.4.47|^4.3|^5.0|^6.0",
                    "symfony/doctrine-bridge": "^3.4|^4.1|^5.0|^6.0",
                    "symfony/http-kernel": "^3.4|^4.3|^5.0|^6.0"
                },
                "require-dev": {
                    "doctrine/coding-standard": "^9",
                    "phpstan/phpstan": "^1.4.10",
                    "phpunit/phpunit": "^7.5.20 || ^8.5.26 || ^9.5.20",
                    "symfony/phpunit-bridge": "^6.0.8",
                    "vimeo/psalm": "^4.22"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Doctrine\\Bundle\\FixturesBundle\\": ""
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Doctrine Project",
                        "homepage": "https://www.doctrine-project.org"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony DoctrineFixturesBundle",
                "homepage": "https://www.doctrine-project.org",
                "keywords": [
                    "Fixture",
                    "persistence"
                ],
                "support": {
                    "issues": "https://github.com/doctrine/DoctrineFixturesBundle/issues",
                    "source": "https://github.com/doctrine/DoctrineFixturesBundle/tree/3.4.4"
                },
                "funding": [
                    {
                        "url": "https://www.doctrine-project.org/sponsorship.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://www.patreon.com/phpdoctrine",
                        "type": "patreon"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/doctrine%2Fdoctrine-fixtures-bundle",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-05-02T15:12:16+00:00"
            },
            {
                "name": "myclabs/deep-copy",
                "version": "1.11.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/myclabs/DeepCopy.git",
                    "reference": "7284c22080590fb39f2ffa3e9057f10a4ddd0e0c"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/myclabs/DeepCopy/zipball/7284c22080590fb39f2ffa3e9057f10a4ddd0e0c",
                    "reference": "7284c22080590fb39f2ffa3e9057f10a4ddd0e0c",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.1 || ^8.0"
                },
                "conflict": {
                    "doctrine/collections": "<1.6.8",
                    "doctrine/common": "<2.13.3 || >=3,<3.2.2"
                },
                "require-dev": {
                    "doctrine/collections": "^1.6.8",
                    "doctrine/common": "^2.13.3 || ^3.2.2",
                    "phpunit/phpunit": "^7.5.20 || ^8.5.23 || ^9.5.13"
                },
                "type": "library",
                "autoload": {
                    "files": [
                        "src/DeepCopy/deep_copy.php"
                    ],
                    "psr-4": {
                        "DeepCopy\\": "src/DeepCopy/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "description": "Create deep copies (clones) of your objects",
                "keywords": [
                    "clone",
                    "copy",
                    "duplicate",
                    "object",
                    "object graph"
                ],
                "support": {
                    "issues": "https://github.com/myclabs/DeepCopy/issues",
                    "source": "https://github.com/myclabs/DeepCopy/tree/1.11.1"
                },
                "funding": [
                    {
                        "url": "https://tidelift.com/funding/github/packagist/myclabs/deep-copy",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-03-08T13:26:56+00:00"
            },
            {
                "name": "nikic/php-parser",
                "version": "v4.17.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/nikic/PHP-Parser.git",
                    "reference": "a6303e50c90c355c7eeee2c4a8b27fe8dc8fef1d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/nikic/PHP-Parser/zipball/a6303e50c90c355c7eeee2c4a8b27fe8dc8fef1d",
                    "reference": "a6303e50c90c355c7eeee2c4a8b27fe8dc8fef1d",
                    "shasum": ""
                },
                "require": {
                    "ext-tokenizer": "*",
                    "php": ">=7.0"
                },
                "require-dev": {
                    "ircmaxell/php-yacc": "^0.0.7",
                    "phpunit/phpunit": "^6.5 || ^7.0 || ^8.0 || ^9.0"
                },
                "bin": [
                    "bin/php-parse"
                ],
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "4.9-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "PhpParser\\": "lib/PhpParser"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Nikita Popov"
                    }
                ],
                "description": "A PHP parser written in PHP",
                "keywords": [
                    "parser",
                    "php"
                ],
                "support": {
                    "issues": "https://github.com/nikic/PHP-Parser/issues",
                    "source": "https://github.com/nikic/PHP-Parser/tree/v4.17.1"
                },
                "time": "2023-08-13T19:53:39+00:00"
            },
            {
                "name": "phar-io/manifest",
                "version": "2.0.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/phar-io/manifest.git",
                    "reference": "97803eca37d319dfa7826cc2437fc020857acb53"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/phar-io/manifest/zipball/97803eca37d319dfa7826cc2437fc020857acb53",
                    "reference": "97803eca37d319dfa7826cc2437fc020857acb53",
                    "shasum": ""
                },
                "require": {
                    "ext-dom": "*",
                    "ext-phar": "*",
                    "ext-xmlwriter": "*",
                    "phar-io/version": "^3.0.1",
                    "php": "^7.2 || ^8.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0.x-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Arne Blankerts",
                        "email": "arne@blankerts.de",
                        "role": "Developer"
                    },
                    {
                        "name": "Sebastian Heuer",
                        "email": "sebastian@phpeople.de",
                        "role": "Developer"
                    },
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "Developer"
                    }
                ],
                "description": "Component for reading phar.io manifest information from a PHP Archive (PHAR)",
                "support": {
                    "issues": "https://github.com/phar-io/manifest/issues",
                    "source": "https://github.com/phar-io/manifest/tree/2.0.3"
                },
                "time": "2021-07-20T11:28:43+00:00"
            },
            {
                "name": "phar-io/version",
                "version": "3.2.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/phar-io/version.git",
                    "reference": "4f7fd7836c6f332bb2933569e566a0d6c4cbed74"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/phar-io/version/zipball/4f7fd7836c6f332bb2933569e566a0d6c4cbed74",
                    "reference": "4f7fd7836c6f332bb2933569e566a0d6c4cbed74",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2 || ^8.0"
                },
                "type": "library",
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Arne Blankerts",
                        "email": "arne@blankerts.de",
                        "role": "Developer"
                    },
                    {
                        "name": "Sebastian Heuer",
                        "email": "sebastian@phpeople.de",
                        "role": "Developer"
                    },
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "Developer"
                    }
                ],
                "description": "Library for handling version information and constraints",
                "support": {
                    "issues": "https://github.com/phar-io/version/issues",
                    "source": "https://github.com/phar-io/version/tree/3.2.1"
                },
                "time": "2022-02-21T01:04:05+00:00"
            },
            {
                "name": "phpstan/phpstan",
                "version": "1.10.29",
                "source": {
                    "type": "git",
                    "url": "https://github.com/phpstan/phpstan.git",
                    "reference": "ee5d8f2d3977fb09e55603eee6fb53bdd76ee9c1"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/phpstan/phpstan/zipball/ee5d8f2d3977fb09e55603eee6fb53bdd76ee9c1",
                    "reference": "ee5d8f2d3977fb09e55603eee6fb53bdd76ee9c1",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2|^8.0"
                },
                "conflict": {
                    "phpstan/phpstan-shim": "*"
                },
                "bin": [
                    "phpstan",
                    "phpstan.phar"
                ],
                "type": "library",
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "description": "PHPStan - PHP Static Analysis Tool",
                "keywords": [
                    "dev",
                    "static analysis"
                ],
                "support": {
                    "docs": "https://phpstan.org/user-guide/getting-started",
                    "forum": "https://github.com/phpstan/phpstan/discussions",
                    "issues": "https://github.com/phpstan/phpstan/issues",
                    "security": "https://github.com/phpstan/phpstan/security/policy",
                    "source": "https://github.com/phpstan/phpstan-src"
                },
                "funding": [
                    {
                        "url": "https://github.com/ondrejmirtes",
                        "type": "github"
                    },
                    {
                        "url": "https://github.com/phpstan",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/phpstan/phpstan",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-08-14T13:24:11+00:00"
            },
            {
                "name": "phpunit/php-code-coverage",
                "version": "9.2.27",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/php-code-coverage.git",
                    "reference": "b0a88255cb70d52653d80c890bd7f38740ea50d1"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/php-code-coverage/zipball/b0a88255cb70d52653d80c890bd7f38740ea50d1",
                    "reference": "b0a88255cb70d52653d80c890bd7f38740ea50d1",
                    "shasum": ""
                },
                "require": {
                    "ext-dom": "*",
                    "ext-libxml": "*",
                    "ext-xmlwriter": "*",
                    "nikic/php-parser": "^4.15",
                    "php": ">=7.3",
                    "phpunit/php-file-iterator": "^3.0.3",
                    "phpunit/php-text-template": "^2.0.2",
                    "sebastian/code-unit-reverse-lookup": "^2.0.2",
                    "sebastian/complexity": "^2.0",
                    "sebastian/environment": "^5.1.2",
                    "sebastian/lines-of-code": "^1.0.3",
                    "sebastian/version": "^3.0.1",
                    "theseer/tokenizer": "^1.2.0"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "suggest": {
                    "ext-pcov": "PHP extension that provides line coverage",
                    "ext-xdebug": "PHP extension that provides line coverage as well as branch and path coverage"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "9.2-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Library that provides collection, processing, and rendering functionality for PHP code coverage information.",
                "homepage": "https://github.com/sebastianbergmann/php-code-coverage",
                "keywords": [
                    "coverage",
                    "testing",
                    "xunit"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/php-code-coverage/issues",
                    "security": "https://github.com/sebastianbergmann/php-code-coverage/security/policy",
                    "source": "https://github.com/sebastianbergmann/php-code-coverage/tree/9.2.27"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2023-07-26T13:44:30+00:00"
            },
            {
                "name": "phpunit/php-file-iterator",
                "version": "3.0.6",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/php-file-iterator.git",
                    "reference": "cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/php-file-iterator/zipball/cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf",
                    "reference": "cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "FilterIterator implementation that filters files based on a list of suffixes.",
                "homepage": "https://github.com/sebastianbergmann/php-file-iterator/",
                "keywords": [
                    "filesystem",
                    "iterator"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/php-file-iterator/issues",
                    "source": "https://github.com/sebastianbergmann/php-file-iterator/tree/3.0.6"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2021-12-02T12:48:52+00:00"
            },
            {
                "name": "phpunit/php-invoker",
                "version": "3.1.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/php-invoker.git",
                    "reference": "5a10147d0aaf65b58940a0b72f71c9ac0423cc67"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/php-invoker/zipball/5a10147d0aaf65b58940a0b72f71c9ac0423cc67",
                    "reference": "5a10147d0aaf65b58940a0b72f71c9ac0423cc67",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "ext-pcntl": "*",
                    "phpunit/phpunit": "^9.3"
                },
                "suggest": {
                    "ext-pcntl": "*"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.1-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Invoke callables with a timeout",
                "homepage": "https://github.com/sebastianbergmann/php-invoker/",
                "keywords": [
                    "process"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/php-invoker/issues",
                    "source": "https://github.com/sebastianbergmann/php-invoker/tree/3.1.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-09-28T05:58:55+00:00"
            },
            {
                "name": "phpunit/php-text-template",
                "version": "2.0.4",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/php-text-template.git",
                    "reference": "5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/php-text-template/zipball/5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28",
                    "reference": "5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Simple template engine.",
                "homepage": "https://github.com/sebastianbergmann/php-text-template/",
                "keywords": [
                    "template"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/php-text-template/issues",
                    "source": "https://github.com/sebastianbergmann/php-text-template/tree/2.0.4"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-10-26T05:33:50+00:00"
            },
            {
                "name": "phpunit/php-timer",
                "version": "5.0.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/php-timer.git",
                    "reference": "5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/php-timer/zipball/5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2",
                    "reference": "5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "5.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Utility class for timing",
                "homepage": "https://github.com/sebastianbergmann/php-timer/",
                "keywords": [
                    "timer"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/php-timer/issues",
                    "source": "https://github.com/sebastianbergmann/php-timer/tree/5.0.3"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-10-26T13:16:10+00:00"
            },
            {
                "name": "phpunit/phpunit",
                "version": "9.6.10",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/phpunit.git",
                    "reference": "a6d351645c3fe5a30f5e86be6577d946af65a328"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/phpunit/zipball/a6d351645c3fe5a30f5e86be6577d946af65a328",
                    "reference": "a6d351645c3fe5a30f5e86be6577d946af65a328",
                    "shasum": ""
                },
                "require": {
                    "doctrine/instantiator": "^1.3.1 || ^2",
                    "ext-dom": "*",
                    "ext-json": "*",
                    "ext-libxml": "*",
                    "ext-mbstring": "*",
                    "ext-xml": "*",
                    "ext-xmlwriter": "*",
                    "myclabs/deep-copy": "^1.10.1",
                    "phar-io/manifest": "^2.0.3",
                    "phar-io/version": "^3.0.2",
                    "php": ">=7.3",
                    "phpunit/php-code-coverage": "^9.2.13",
                    "phpunit/php-file-iterator": "^3.0.5",
                    "phpunit/php-invoker": "^3.1.1",
                    "phpunit/php-text-template": "^2.0.3",
                    "phpunit/php-timer": "^5.0.2",
                    "sebastian/cli-parser": "^1.0.1",
                    "sebastian/code-unit": "^1.0.6",
                    "sebastian/comparator": "^4.0.8",
                    "sebastian/diff": "^4.0.3",
                    "sebastian/environment": "^5.1.3",
                    "sebastian/exporter": "^4.0.5",
                    "sebastian/global-state": "^5.0.1",
                    "sebastian/object-enumerator": "^4.0.3",
                    "sebastian/resource-operations": "^3.0.3",
                    "sebastian/type": "^3.2",
                    "sebastian/version": "^3.0.2"
                },
                "suggest": {
                    "ext-soap": "To be able to generate mocks based on WSDL files",
                    "ext-xdebug": "PHP extension that provides line coverage as well as branch and path coverage"
                },
                "bin": [
                    "phpunit"
                ],
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "9.6-dev"
                    }
                },
                "autoload": {
                    "files": [
                        "src/Framework/Assert/Functions.php"
                    ],
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "The PHP Unit Testing framework.",
                "homepage": "https://phpunit.de/",
                "keywords": [
                    "phpunit",
                    "testing",
                    "xunit"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/phpunit/issues",
                    "security": "https://github.com/sebastianbergmann/phpunit/security/policy",
                    "source": "https://github.com/sebastianbergmann/phpunit/tree/9.6.10"
                },
                "funding": [
                    {
                        "url": "https://phpunit.de/sponsors.html",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/phpunit/phpunit",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-10T04:04:23+00:00"
            },
            {
                "name": "rector/rector",
                "version": "0.17.13",
                "source": {
                    "type": "git",
                    "url": "https://github.com/rectorphp/rector.git",
                    "reference": "e2003ba7c5bda06d7bb419cf4be8dae5f8672132"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/rectorphp/rector/zipball/e2003ba7c5bda06d7bb419cf4be8dae5f8672132",
                    "reference": "e2003ba7c5bda06d7bb419cf4be8dae5f8672132",
                    "shasum": ""
                },
                "require": {
                    "php": "^7.2|^8.0",
                    "phpstan/phpstan": "^1.10.26"
                },
                "conflict": {
                    "rector/rector-doctrine": "*",
                    "rector/rector-downgrade-php": "*",
                    "rector/rector-phpunit": "*",
                    "rector/rector-symfony": "*"
                },
                "bin": [
                    "bin/rector"
                ],
                "type": "library",
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "description": "Instant Upgrade and Automated Refactoring of any PHP code",
                "keywords": [
                    "automation",
                    "dev",
                    "migration",
                    "refactoring"
                ],
                "support": {
                    "issues": "https://github.com/rectorphp/rector/issues",
                    "source": "https://github.com/rectorphp/rector/tree/0.17.13"
                },
                "funding": [
                    {
                        "url": "https://github.com/tomasvotruba",
                        "type": "github"
                    }
                ],
                "time": "2023-08-14T16:33:29+00:00"
            },
            {
                "name": "sebastian/cli-parser",
                "version": "1.0.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/cli-parser.git",
                    "reference": "442e7c7e687e42adc03470c7b668bc4b2402c0b2"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/cli-parser/zipball/442e7c7e687e42adc03470c7b668bc4b2402c0b2",
                    "reference": "442e7c7e687e42adc03470c7b668bc4b2402c0b2",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Library for parsing CLI options",
                "homepage": "https://github.com/sebastianbergmann/cli-parser",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/cli-parser/issues",
                    "source": "https://github.com/sebastianbergmann/cli-parser/tree/1.0.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-09-28T06:08:49+00:00"
            },
            {
                "name": "sebastian/code-unit",
                "version": "1.0.8",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/code-unit.git",
                    "reference": "1fc9f64c0927627ef78ba436c9b17d967e68e120"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/code-unit/zipball/1fc9f64c0927627ef78ba436c9b17d967e68e120",
                    "reference": "1fc9f64c0927627ef78ba436c9b17d967e68e120",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Collection of value objects that represent the PHP code units",
                "homepage": "https://github.com/sebastianbergmann/code-unit",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/code-unit/issues",
                    "source": "https://github.com/sebastianbergmann/code-unit/tree/1.0.8"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-10-26T13:08:54+00:00"
            },
            {
                "name": "sebastian/code-unit-reverse-lookup",
                "version": "2.0.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/code-unit-reverse-lookup.git",
                    "reference": "ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/code-unit-reverse-lookup/zipball/ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5",
                    "reference": "ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    }
                ],
                "description": "Looks up which function or method a line of code belongs to",
                "homepage": "https://github.com/sebastianbergmann/code-unit-reverse-lookup/",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/code-unit-reverse-lookup/issues",
                    "source": "https://github.com/sebastianbergmann/code-unit-reverse-lookup/tree/2.0.3"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-09-28T05:30:19+00:00"
            },
            {
                "name": "sebastian/comparator",
                "version": "4.0.8",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/comparator.git",
                    "reference": "fa0f136dd2334583309d32b62544682ee972b51a"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/comparator/zipball/fa0f136dd2334583309d32b62544682ee972b51a",
                    "reference": "fa0f136dd2334583309d32b62544682ee972b51a",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3",
                    "sebastian/diff": "^4.0",
                    "sebastian/exporter": "^4.0"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "4.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    },
                    {
                        "name": "Jeff Welch",
                        "email": "whatthejeff@gmail.com"
                    },
                    {
                        "name": "Volker Dusch",
                        "email": "github@wallbash.com"
                    },
                    {
                        "name": "Bernhard Schussek",
                        "email": "bschussek@2bepublished.at"
                    }
                ],
                "description": "Provides the functionality to compare PHP values for equality",
                "homepage": "https://github.com/sebastianbergmann/comparator",
                "keywords": [
                    "comparator",
                    "compare",
                    "equality"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/comparator/issues",
                    "source": "https://github.com/sebastianbergmann/comparator/tree/4.0.8"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2022-09-14T12:41:17+00:00"
            },
            {
                "name": "sebastian/complexity",
                "version": "2.0.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/complexity.git",
                    "reference": "739b35e53379900cc9ac327b2147867b8b6efd88"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/complexity/zipball/739b35e53379900cc9ac327b2147867b8b6efd88",
                    "reference": "739b35e53379900cc9ac327b2147867b8b6efd88",
                    "shasum": ""
                },
                "require": {
                    "nikic/php-parser": "^4.7",
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Library for calculating the complexity of PHP code units",
                "homepage": "https://github.com/sebastianbergmann/complexity",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/complexity/issues",
                    "source": "https://github.com/sebastianbergmann/complexity/tree/2.0.2"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-10-26T15:52:27+00:00"
            },
            {
                "name": "sebastian/diff",
                "version": "4.0.5",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/diff.git",
                    "reference": "74be17022044ebaaecfdf0c5cd504fc9cd5a7131"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/diff/zipball/74be17022044ebaaecfdf0c5cd504fc9cd5a7131",
                    "reference": "74be17022044ebaaecfdf0c5cd504fc9cd5a7131",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3",
                    "symfony/process": "^4.2 || ^5"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "4.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    },
                    {
                        "name": "Kore Nordmann",
                        "email": "mail@kore-nordmann.de"
                    }
                ],
                "description": "Diff implementation",
                "homepage": "https://github.com/sebastianbergmann/diff",
                "keywords": [
                    "diff",
                    "udiff",
                    "unidiff",
                    "unified diff"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/diff/issues",
                    "source": "https://github.com/sebastianbergmann/diff/tree/4.0.5"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2023-05-07T05:35:17+00:00"
            },
            {
                "name": "sebastian/environment",
                "version": "5.1.5",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/environment.git",
                    "reference": "830c43a844f1f8d5b7a1f6d6076b784454d8b7ed"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/environment/zipball/830c43a844f1f8d5b7a1f6d6076b784454d8b7ed",
                    "reference": "830c43a844f1f8d5b7a1f6d6076b784454d8b7ed",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "suggest": {
                    "ext-posix": "*"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "5.1-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    }
                ],
                "description": "Provides functionality to handle HHVM/PHP environments",
                "homepage": "http://www.github.com/sebastianbergmann/environment",
                "keywords": [
                    "Xdebug",
                    "environment",
                    "hhvm"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/environment/issues",
                    "source": "https://github.com/sebastianbergmann/environment/tree/5.1.5"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2023-02-03T06:03:51+00:00"
            },
            {
                "name": "sebastian/exporter",
                "version": "4.0.5",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/exporter.git",
                    "reference": "ac230ed27f0f98f597c8a2b6eb7ac563af5e5b9d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/exporter/zipball/ac230ed27f0f98f597c8a2b6eb7ac563af5e5b9d",
                    "reference": "ac230ed27f0f98f597c8a2b6eb7ac563af5e5b9d",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3",
                    "sebastian/recursion-context": "^4.0"
                },
                "require-dev": {
                    "ext-mbstring": "*",
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "4.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    },
                    {
                        "name": "Jeff Welch",
                        "email": "whatthejeff@gmail.com"
                    },
                    {
                        "name": "Volker Dusch",
                        "email": "github@wallbash.com"
                    },
                    {
                        "name": "Adam Harvey",
                        "email": "aharvey@php.net"
                    },
                    {
                        "name": "Bernhard Schussek",
                        "email": "bschussek@gmail.com"
                    }
                ],
                "description": "Provides the functionality to export PHP variables for visualization",
                "homepage": "https://www.github.com/sebastianbergmann/exporter",
                "keywords": [
                    "export",
                    "exporter"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/exporter/issues",
                    "source": "https://github.com/sebastianbergmann/exporter/tree/4.0.5"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2022-09-14T06:03:37+00:00"
            },
            {
                "name": "sebastian/global-state",
                "version": "5.0.6",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/global-state.git",
                    "reference": "bde739e7565280bda77be70044ac1047bc007e34"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/global-state/zipball/bde739e7565280bda77be70044ac1047bc007e34",
                    "reference": "bde739e7565280bda77be70044ac1047bc007e34",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3",
                    "sebastian/object-reflector": "^2.0",
                    "sebastian/recursion-context": "^4.0"
                },
                "require-dev": {
                    "ext-dom": "*",
                    "phpunit/phpunit": "^9.3"
                },
                "suggest": {
                    "ext-uopz": "*"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "5.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    }
                ],
                "description": "Snapshotting of global state",
                "homepage": "http://www.github.com/sebastianbergmann/global-state",
                "keywords": [
                    "global state"
                ],
                "support": {
                    "issues": "https://github.com/sebastianbergmann/global-state/issues",
                    "source": "https://github.com/sebastianbergmann/global-state/tree/5.0.6"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2023-08-02T09:26:13+00:00"
            },
            {
                "name": "sebastian/lines-of-code",
                "version": "1.0.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/lines-of-code.git",
                    "reference": "c1c2e997aa3146983ed888ad08b15470a2e22ecc"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/lines-of-code/zipball/c1c2e997aa3146983ed888ad08b15470a2e22ecc",
                    "reference": "c1c2e997aa3146983ed888ad08b15470a2e22ecc",
                    "shasum": ""
                },
                "require": {
                    "nikic/php-parser": "^4.6",
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "1.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Library for counting the lines of code in PHP source code",
                "homepage": "https://github.com/sebastianbergmann/lines-of-code",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/lines-of-code/issues",
                    "source": "https://github.com/sebastianbergmann/lines-of-code/tree/1.0.3"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-11-28T06:42:11+00:00"
            },
            {
                "name": "sebastian/object-enumerator",
                "version": "4.0.4",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/object-enumerator.git",
                    "reference": "5c9eeac41b290a3712d88851518825ad78f45c71"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/object-enumerator/zipball/5c9eeac41b290a3712d88851518825ad78f45c71",
                    "reference": "5c9eeac41b290a3712d88851518825ad78f45c71",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3",
                    "sebastian/object-reflector": "^2.0",
                    "sebastian/recursion-context": "^4.0"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "4.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    }
                ],
                "description": "Traverses array structures and object graphs to enumerate all referenced objects",
                "homepage": "https://github.com/sebastianbergmann/object-enumerator/",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/object-enumerator/issues",
                    "source": "https://github.com/sebastianbergmann/object-enumerator/tree/4.0.4"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-10-26T13:12:34+00:00"
            },
            {
                "name": "sebastian/object-reflector",
                "version": "2.0.4",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/object-reflector.git",
                    "reference": "b4f479ebdbf63ac605d183ece17d8d7fe49c15c7"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/object-reflector/zipball/b4f479ebdbf63ac605d183ece17d8d7fe49c15c7",
                    "reference": "b4f479ebdbf63ac605d183ece17d8d7fe49c15c7",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "2.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    }
                ],
                "description": "Allows reflection of object attributes, including inherited and non-public ones",
                "homepage": "https://github.com/sebastianbergmann/object-reflector/",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/object-reflector/issues",
                    "source": "https://github.com/sebastianbergmann/object-reflector/tree/2.0.4"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-10-26T13:14:26+00:00"
            },
            {
                "name": "sebastian/recursion-context",
                "version": "4.0.5",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/recursion-context.git",
                    "reference": "e75bd0f07204fec2a0af9b0f3cfe97d05f92efc1"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/recursion-context/zipball/e75bd0f07204fec2a0af9b0f3cfe97d05f92efc1",
                    "reference": "e75bd0f07204fec2a0af9b0f3cfe97d05f92efc1",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "4.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    },
                    {
                        "name": "Jeff Welch",
                        "email": "whatthejeff@gmail.com"
                    },
                    {
                        "name": "Adam Harvey",
                        "email": "aharvey@php.net"
                    }
                ],
                "description": "Provides functionality to recursively process PHP variables",
                "homepage": "https://github.com/sebastianbergmann/recursion-context",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/recursion-context/issues",
                    "source": "https://github.com/sebastianbergmann/recursion-context/tree/4.0.5"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2023-02-03T06:07:39+00:00"
            },
            {
                "name": "sebastian/resource-operations",
                "version": "3.0.3",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/resource-operations.git",
                    "reference": "0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/resource-operations/zipball/0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8",
                    "reference": "0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.0"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de"
                    }
                ],
                "description": "Provides a list of PHP built-in functions that operate on resources",
                "homepage": "https://www.github.com/sebastianbergmann/resource-operations",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/resource-operations/issues",
                    "source": "https://github.com/sebastianbergmann/resource-operations/tree/3.0.3"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-09-28T06:45:17+00:00"
            },
            {
                "name": "sebastian/type",
                "version": "3.2.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/type.git",
                    "reference": "75e2c2a32f5e0b3aef905b9ed0b179b953b3d7c7"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/type/zipball/75e2c2a32f5e0b3aef905b9ed0b179b953b3d7c7",
                    "reference": "75e2c2a32f5e0b3aef905b9ed0b179b953b3d7c7",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "require-dev": {
                    "phpunit/phpunit": "^9.5"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.2-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Collection of value objects that represent the types of the PHP type system",
                "homepage": "https://github.com/sebastianbergmann/type",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/type/issues",
                    "source": "https://github.com/sebastianbergmann/type/tree/3.2.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2023-02-03T06:13:03+00:00"
            },
            {
                "name": "sebastian/version",
                "version": "3.0.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/sebastianbergmann/version.git",
                    "reference": "c6c1022351a901512170118436c764e473f6de8c"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/sebastianbergmann/version/zipball/c6c1022351a901512170118436c764e473f6de8c",
                    "reference": "c6c1022351a901512170118436c764e473f6de8c",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.3"
                },
                "type": "library",
                "extra": {
                    "branch-alias": {
                        "dev-master": "3.0-dev"
                    }
                },
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Sebastian Bergmann",
                        "email": "sebastian@phpunit.de",
                        "role": "lead"
                    }
                ],
                "description": "Library that helps with managing the version number of Git-hosted PHP projects",
                "homepage": "https://github.com/sebastianbergmann/version",
                "support": {
                    "issues": "https://github.com/sebastianbergmann/version/issues",
                    "source": "https://github.com/sebastianbergmann/version/tree/3.0.2"
                },
                "funding": [
                    {
                        "url": "https://github.com/sebastianbergmann",
                        "type": "github"
                    }
                ],
                "time": "2020-09-28T06:39:44+00:00"
            },
            {
                "name": "symfony/browser-kit",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/browser-kit.git",
                    "reference": "ca4a988488f61ac18f8f845445eabdd36f89aa8d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/browser-kit/zipball/ca4a988488f61ac18f8f845445eabdd36f89aa8d",
                    "reference": "ca4a988488f61ac18f8f845445eabdd36f89aa8d",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/dom-crawler": "^5.4|^6.0"
                },
                "require-dev": {
                    "symfony/css-selector": "^5.4|^6.0",
                    "symfony/http-client": "^5.4|^6.0",
                    "symfony/mime": "^5.4|^6.0",
                    "symfony/process": "^5.4|^6.0"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\BrowserKit\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Simulates the behavior of a web browser, allowing you to make requests, click on links and submit forms programmatically",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/browser-kit/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-06T06:56:43+00:00"
            },
            {
                "name": "symfony/css-selector",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/css-selector.git",
                    "reference": "883d961421ab1709877c10ac99451632a3d6fa57"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/css-selector/zipball/883d961421ab1709877c10ac99451632a3d6fa57",
                    "reference": "883d961421ab1709877c10ac99451632a3d6fa57",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1"
                },
                "type": "library",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Component\\CssSelector\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Jean-François Simon",
                        "email": "jeanfrancois.simon@sensiolabs.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Converts CSS selectors to XPath expressions",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/css-selector/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-12T16:00:22+00:00"
            },
            {
                "name": "symfony/debug-bundle",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/debug-bundle.git",
                    "reference": "3f04a578e1a9f1d7da84a87b690c03123e5d8c31"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/debug-bundle/zipball/3f04a578e1a9f1d7da84a87b690c03123e5d8c31",
                    "reference": "3f04a578e1a9f1d7da84a87b690c03123e5d8c31",
                    "shasum": ""
                },
                "require": {
                    "ext-xml": "*",
                    "php": ">=8.1",
                    "symfony/dependency-injection": "^5.4|^6.0",
                    "symfony/http-kernel": "^5.4|^6.0",
                    "symfony/twig-bridge": "^5.4|^6.0",
                    "symfony/var-dumper": "^5.4|^6.0"
                },
                "conflict": {
                    "symfony/config": "<5.4",
                    "symfony/dependency-injection": "<5.4"
                },
                "require-dev": {
                    "symfony/config": "^5.4|^6.0",
                    "symfony/web-profiler-bundle": "^5.4|^6.0"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bundle\\DebugBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides a tight integration of the Symfony VarDumper component and the ServerLogCommand from MonologBridge into the Symfony full-stack framework",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/debug-bundle/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-13T14:29:38+00:00"
            },
            {
                "name": "symfony/maker-bundle",
                "version": "v1.50.0",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/maker-bundle.git",
                    "reference": "a1733f849b999460c308e66f6392fb09b621fa86"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/maker-bundle/zipball/a1733f849b999460c308e66f6392fb09b621fa86",
                    "reference": "a1733f849b999460c308e66f6392fb09b621fa86",
                    "shasum": ""
                },
                "require": {
                    "doctrine/inflector": "^2.0",
                    "nikic/php-parser": "^4.11",
                    "php": ">=8.0",
                    "symfony/config": "^5.4.7|^6.0",
                    "symfony/console": "^5.4.7|^6.0",
                    "symfony/dependency-injection": "^5.4.7|^6.0",
                    "symfony/deprecation-contracts": "^2.2|^3",
                    "symfony/filesystem": "^5.4.7|^6.0",
                    "symfony/finder": "^5.4.3|^6.0",
                    "symfony/framework-bundle": "^5.4.7|^6.0",
                    "symfony/http-kernel": "^5.4.7|^6.0",
                    "symfony/process": "^5.4.7|^6.0"
                },
                "conflict": {
                    "doctrine/doctrine-bundle": "<2.4",
                    "doctrine/orm": "<2.10",
                    "symfony/doctrine-bridge": "<5.4"
                },
                "require-dev": {
                    "composer/semver": "^3.0",
                    "doctrine/doctrine-bundle": "^2.4",
                    "doctrine/orm": "^2.10.0",
                    "symfony/http-client": "^5.4.7|^6.0",
                    "symfony/phpunit-bridge": "^5.4.17|^6.0",
                    "symfony/polyfill-php80": "^1.16.0",
                    "symfony/security-core": "^5.4.7|^6.0",
                    "symfony/yaml": "^5.4.3|^6.0",
                    "twig/twig": "^2.0|^3.0"
                },
                "type": "symfony-bundle",
                "extra": {
                    "branch-alias": {
                        "dev-main": "1.0-dev"
                    }
                },
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bundle\\MakerBundle\\": "src/"
                    }
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Symfony Maker helps you create empty commands, controllers, form classes, tests and more so you can forget about writing boilerplate code.",
                "homepage": "https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html",
                "keywords": [
                    "code generator",
                    "dev",
                    "generator",
                    "scaffold",
                    "scaffolding"
                ],
                "support": {
                    "issues": "https://github.com/symfony/maker-bundle/issues",
                    "source": "https://github.com/symfony/maker-bundle/tree/v1.50.0"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-10T18:21:57+00:00"
            },
            {
                "name": "symfony/phpunit-bridge",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/phpunit-bridge.git",
                    "reference": "e020e1efbd1b42cb670fcd7d19a25abbddba035d"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/phpunit-bridge/zipball/e020e1efbd1b42cb670fcd7d19a25abbddba035d",
                    "reference": "e020e1efbd1b42cb670fcd7d19a25abbddba035d",
                    "shasum": ""
                },
                "require": {
                    "php": ">=7.1.3"
                },
                "conflict": {
                    "phpunit/phpunit": "<7.5|9.1.2"
                },
                "require-dev": {
                    "symfony/deprecation-contracts": "^2.5|^3.0",
                    "symfony/error-handler": "^5.4|^6.0",
                    "symfony/polyfill-php81": "^1.27"
                },
                "bin": [
                    "bin/simple-phpunit"
                ],
                "type": "symfony-bridge",
                "extra": {
                    "thanks": {
                        "name": "phpunit/phpunit",
                        "url": "https://github.com/sebastianbergmann/phpunit"
                    }
                },
                "autoload": {
                    "files": [
                        "bootstrap.php"
                    ],
                    "psr-4": {
                        "Symfony\\Bridge\\PhpUnit\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Nicolas Grekas",
                        "email": "p@tchwork.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides utilities for PHPUnit, especially user deprecation notices management",
                "homepage": "https://symfony.com",
                "support": {
                    "source": "https://github.com/symfony/phpunit-bridge/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-12T16:00:22+00:00"
            },
            {
                "name": "symfony/web-profiler-bundle",
                "version": "v6.3.2",
                "source": {
                    "type": "git",
                    "url": "https://github.com/symfony/web-profiler-bundle.git",
                    "reference": "6101b5ab7857c373d237e121f9060c68b32e1373"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/symfony/web-profiler-bundle/zipball/6101b5ab7857c373d237e121f9060c68b32e1373",
                    "reference": "6101b5ab7857c373d237e121f9060c68b32e1373",
                    "shasum": ""
                },
                "require": {
                    "php": ">=8.1",
                    "symfony/config": "^5.4|^6.0",
                    "symfony/framework-bundle": "^5.4|^6.0",
                    "symfony/http-kernel": "^6.3",
                    "symfony/routing": "^5.4|^6.0",
                    "symfony/twig-bundle": "^5.4|^6.0",
                    "twig/twig": "^2.13|^3.0.4"
                },
                "conflict": {
                    "symfony/form": "<5.4",
                    "symfony/mailer": "<5.4",
                    "symfony/messenger": "<5.4"
                },
                "require-dev": {
                    "symfony/browser-kit": "^5.4|^6.0",
                    "symfony/console": "^5.4|^6.0",
                    "symfony/css-selector": "^5.4|^6.0",
                    "symfony/stopwatch": "^5.4|^6.0"
                },
                "type": "symfony-bundle",
                "autoload": {
                    "psr-4": {
                        "Symfony\\Bundle\\WebProfilerBundle\\": ""
                    },
                    "exclude-from-classmap": [
                        "/Tests/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "MIT"
                ],
                "authors": [
                    {
                        "name": "Fabien Potencier",
                        "email": "fabien@symfony.com"
                    },
                    {
                        "name": "Symfony Community",
                        "homepage": "https://symfony.com/contributors"
                    }
                ],
                "description": "Provides a development tool that gives detailed information about the execution of any request",
                "homepage": "https://symfony.com",
                "keywords": [
                    "dev"
                ],
                "support": {
                    "source": "https://github.com/symfony/web-profiler-bundle/tree/v6.3.2"
                },
                "funding": [
                    {
                        "url": "https://symfony.com/sponsor",
                        "type": "custom"
                    },
                    {
                        "url": "https://github.com/fabpot",
                        "type": "github"
                    },
                    {
                        "url": "https://tidelift.com/funding/github/packagist/symfony/symfony",
                        "type": "tidelift"
                    }
                ],
                "time": "2023-07-19T20:17:28+00:00"
            },
            {
                "name": "theseer/tokenizer",
                "version": "1.2.1",
                "source": {
                    "type": "git",
                    "url": "https://github.com/theseer/tokenizer.git",
                    "reference": "34a41e998c2183e22995f158c581e7b5e755ab9e"
                },
                "dist": {
                    "type": "zip",
                    "url": "https://api.github.com/repos/theseer/tokenizer/zipball/34a41e998c2183e22995f158c581e7b5e755ab9e",
                    "reference": "34a41e998c2183e22995f158c581e7b5e755ab9e",
                    "shasum": ""
                },
                "require": {
                    "ext-dom": "*",
                    "ext-tokenizer": "*",
                    "ext-xmlwriter": "*",
                    "php": "^7.2 || ^8.0"
                },
                "type": "library",
                "autoload": {
                    "classmap": [
                        "src/"
                    ]
                },
                "notification-url": "https://packagist.org/downloads/",
                "license": [
                    "BSD-3-Clause"
                ],
                "authors": [
                    {
                        "name": "Arne Blankerts",
                        "email": "arne@blankerts.de",
                        "role": "Developer"
                    }
                ],
                "description": "A small library for converting tokenized PHP source code into XML and potentially other formats",
                "support": {
                    "issues": "https://github.com/theseer/tokenizer/issues",
                    "source": "https://github.com/theseer/tokenizer/tree/1.2.1"
                },
                "funding": [
                    {
                        "url": "https://github.com/theseer",
                        "type": "github"
                    }
                ],
                "time": "2021-07-28T10:34:58+00:00"
            }
        ],
        "aliases": [],
        "minimum-stability": "stable",
        "stability-flags": [],
        "prefer-stable": true,
        "prefer-lowest": false,
        "platform": {
            "php": ">=8.1",
            "ext-ctype": "*",
            "ext-iconv": "*"
        },
        "platform-dev": [],
        "plugin-api-version": "2.3.0"
    }
    */
