<?php

namespace App\Form;

use App\Entity\Annoucement;
use App\Entity\Departements;
use App\Entity\Regions;
use App\Entity\VillesFrance;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class AddAnnoucementType extends AbstractType
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Price')
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
            ])


            ->add('departement_id', ChoiceType::class, [
                'placeholder' => 'Département (choisir une région)',
                //'mapped' => false,
                'required' => false

            ])
            ->add('villesfrance_id', ChoiceType::class, [
                'placeholder' => 'Ville (choisir un département)',
                'mapped' => false,
                'required' => false

            ])
            ->add('Ajouter', SubmitType::class);

        $formModifierRegion = function (FormInterface $form, Regions $region = null) {
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

        $formModifierDepartement = function (FormInterface $form, Departements $departement = null) {
            $villesfrance = null === $departement ? [] : $departement->getVillesFrance();

            $form->add('villesfrance_id', EntityType::class, [
                'class' => VillesFrance::class,
                'choices' => $villesfrance,
                'choice_label' => 'villeNom',
                'placeholder' => 'Villes (choisir un département)',
                'label' => 'Ville',
                'required' => false
            ]);
        };
        $builder->get('regions')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifierRegion) {
                $region = $event->getForm()->getData();
                $formModifierRegion($event->getForm()->getParent(), $region);
            }
        );


        if ($formModifierDepartement != null) {
            $builder->get('departement_id')->addEventListener(
                FormEvents::POST_SET_DATA,
                function (FormEvent $event) use ($formModifierDepartement) {
                    $departement = $event->getForm()->getData();
                    $formModifierDepartement($event->getForm()->getParent(), $departement);
                }
            );
        }
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
