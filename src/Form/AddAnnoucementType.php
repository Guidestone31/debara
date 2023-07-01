<?php

namespace App\Form;

use App\Entity\Annoucement;
use App\Entity\Departements;
use App\Entity\Regions;
use App\Entity\VillesFrance;
use App\Entity\VillesFranceRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AddAnnoucementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Price')
            /*->add('villesfrance', EntityType::class, [
                'mapped' => false,
                'class' => VillesFrance::class,
                'choice_label' => 'villeNom',
                'placeholder' => 'Villes',
                'label' => 'Villes',
                'required' => false

            ])*/
            ->add('Description')
            ->add('Image', FileType::class, [
                'label' => 'Image (PNG et JPG file)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez utiliser un format valide !',
                    ])
                ],
            ])
            ->add('regions', EntityType::class, [
                'mapped' => false,
                'class' => Regions::class,
                'choice_label' => 'nom',
                'placeholder' => 'Régions',
                'label' => 'Régions',
                'required' => false
            ]);
        /*
        $builder->get('regions')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addDepartementField($form->getParent(), $form->getData());
            }
        );*/
        /*
            ->add('departement_id', ChoiceType::class, [
                'placeholder' => 'Département (choisir une région)',
                //'mapped' => false,
                'required' => false

            ])
            ->add('villesfrance_id', ChoiceType::class, [
                'placeholder' => 'Ville (choisir un département)',
                'mapped' => false,
                'required' => false

            ])*/
        //
        //->add('Ajouter', SubmitType::class);
        /*
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                $ville = $data->getVillesfranceId();
                $form = $event->getForm();
                if ($ville) {
                    $departement = $ville->getDepartementCode();
                    $region = $departement->getIdRegionDpt();
                    $this->addDepartementField($form, $region);
                    $this->addVilleFrance($form, $departement);
                    $form->get('regions')->setData($region);
                    $form->get('departement_id')->setData($departement);
                } else {
                    // On crée les 2 champs en les laissant vide (champs utilisé pour le JavaScript)
                    $this->addDepartementField($form, null);
                    $this->addVilleFrance($form, null);
                }
            }
        );*/

        /* $formModifierRegion = function (FormInterface $form, Regions $region = null) {
             $departement = null === $region ? [] : $region->getDepartements();


             $form->add('departement_id', EntityType::class, [
                 'class' => Departements::class,
                 'choices' => $departement,
                 'choice_label' => 'nom',
                 'placeholder' => 'Départements (choisir une région)',
                 'label' => 'Départements',
                 'required' => false
             ]);
         };
         $builder->get('regions')->addEventListener(
             FormEvents::POST_SUBMIT,
             function (FormEvent $event) use ($formModifierRegion) {
                 $region = $event->getForm()->getData();

                 $builder = $region->getParent()->getConfig()->getFormFactory()->createNamedBuilder(
                     'departement_id',
                     EntityType::class,
                     null,
                     $formModifierRegion($event->getForm()->getParent(), $region)
                 );
             },
         );*/

        /* $formModifierDepartement = function (FormInterface $form, Departements $departement = null) {
             $villesfrance = null === $departement ? [] : $departement->getVillesFrance();

             $form->add('villesfrance_id', EntityType::class, [
                 'class' => VillesFrance::class,
                 'choices' => $villesfrance,
                 'choice_label' => 'villeNom',
                 'placeholder' => 'Villes (choisir un département)',
                 'label' => 'Ville',
                 'required' => false
             ]);
         };*/
        /*

         $formModifier = function (FormInterface $form, Regions $region = null) {
             $departement = null === $region ? [] : $region->getDepartements();
             $form->add('departement_id', EntityType::class, [
                 'class' => Departements::class,
                 'choices' => $departement,
                 'choice_label' => 'nom',
                 'placeholder' => 'Départements (choisir une région)',
                 'label' => 'Départements',
                 'required' => false
             ]);
         };

         $formModifierV = function (FormInterface $form, Departements $dep = null) {
             $villesfrance = null === $dep ? [] : $dep->getVillesFrance();
             $form->add('villesfrance', EntityType::class, [
                 'class' => VillesFrance::class,
                 'choices' => $villesfrance,
                 'choice_label' => 'villeNom',
                 'placeholder' => 'Villes (choisir un département)',
                 'label' => 'Ville',
                 'required' => false
             ]);
         };
         */
    }
    /*
    private function addDepartementField(FormInterface $form, ?Regions $region)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'departement_id',
            EntityType::class,
            null,
            [
                'class'           => Departements::class,
                'placeholder'     => $region ? 'Sélectionnez votre département' : 'Sélectionnez votre région',
                'mapped'          => false,
                'required'        => false,
                'auto_initialize' => false,
                'choices'         => $region ? $region->getDepartements() : []
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addVilleFrance($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }
    private function addVilleFrance(FormInterface $form, ?Departements $departement)
    {
        $form->add('villesfrance_id', EntityType::class, [
            'class'       => VillesFrance::class,
            'auto_initialize' => false,
            'placeholder' => $departement ? 'Sélectionnez votre ville' : 'Sélectionnez votre département',
            'choices'     => $departement ? $departement->getVillesFrance() : []
        ]);
    }*/
    /*
                private function addSubCategoryField(FormInterface $form, ?VillesFrance $villesFrance): void
                {
                    if ($villesFrance !== null) {
                        if ($villesFrance === true) {
                            $form->add(
                                'subCategory',
                                EntityType::class,
                                [
                                    'class' => VillesFrance::class,
                                    'choices' => $villesFrance->getVilleNom(),
                                    'choice_label' => 'villeNom',
                                    'required' => true,
                                    'placeholder' => 'Select one sub-category',
                                    'empty_data' => ''
                                ]
                            );
                        }
                        $form->add(
                            'villeNom',
                            TextType::class,
                            [
                                'required' => true,
                                'empty_data' => ''
                            ]
                        );
                    }
                }*/
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annoucement::class,
        ]);
    }
}
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
