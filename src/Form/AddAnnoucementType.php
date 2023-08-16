<?php

namespace App\Form;

use App\Entity\Annoucement;
use App\Entity\Category;
use App\Entity\Departements;
use App\Entity\Regions;
use App\Entity\SubCategoryOne;
use App\Entity\VillesFrance;
use App\Entity\Picture;
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
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Positive;

class AddAnnoucementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('price', MoneyType::class, options: [
                'label' => 'Prix',
                'divisor' => 100,
                'constraints' => [
                    new Positive(
                        message: 'Le prix ne peut être négatif'
                    )
                ]
            ])
            ->add('Description')
            /*->add('Image', FileType::class, [

                'label' => false,
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'multiple' => true,
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
                ]
            ])*/
            /* ->add('lat', EntityType::class, [
                'mapped' => false,
                'class' => VillesFrance::class,
                'choice_label' => 'lat',
                'placeholder' => 'Longitude',
                'label' => 'Longitude',
                'required' => false
            ])
            ->add('lng', EntityType::class, [
                'mapped' => false,
                'class' => VillesFrance::class,
                'choice_label' => 'lng',
                'placeholder' => 'Longitude',
                'label' => 'Longitude',
                'required' => false
            ])*/
            ->add('Image', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new All(
                        new Image([
                            'maxWidth' => 1280,
                            'maxWidthMessage' => 'L\'image doit faire {{ max_width }} pixels de large au maximum'
                        ])
                    )
                ]
            ])
            ->add('category', EntityType::class, [
                'mapped' => false,
                'class' => Category::class,
                'choice_label' => 'Name',
                'placeholder' => 'Catégorie',
                'label' => 'Catégorie',
                'required' => false
            ])
            ->add('SubCategoryO', ChoiceType::class, [
                'placeholder' => 'Subcatégorie (choisir une catégorie)',
                'label' => 'Sous-catégorie',
                'required' => false

            ])
            ->add('regions', EntityType::class, [
                'class' => Regions::class,
                'choice_label' => 'nom',
                'placeholder' => 'Régions',
                'label' => 'Régions',
                'mapped' => false,
                'required' => false
            ]);
        $formModifier = function (FormInterface $form, Category $category = null) {
            $subcategory = null === $category ? [] : $category->getSubCategoryOne();

            $form->add('SubCategoryO', EntityType::class, [
                'class' => SubCategoryOne::class,
                'choices' => $subcategory,
                'choice_label' => 'Name',
                'placeholder' => 'Sous catégorie (choisir une région)',
                'label' => 'Sous catégories',
                'required' => false

            ]);
        };
        $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $category = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $category);
            }
        );

        $builder->get('regions')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addDepartementField($form->getParent(), $form->getData());
            }
        );
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
        );
        //->add('Ajouter', SubmitType::class);
    }

    private function addDepartementField(FormInterface $form, ?Regions $region)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'departement_id',
            EntityType::class,
            null,
            [
                'class'           => Departements::class,
                'placeholder'     => $region ? 'Sélectionnez votre département' : 'Sélectionnez votre région',
                'label'           => 'Départements',
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
            'class'           => VillesFrance::class,
            'auto_initialize' => false,
            'label'           => 'Villes',
            'placeholder'     => $departement ? 'Sélectionnez votre ville' : 'Sélectionnez votre département',
            'choices'         => $departement ? $departement->getVillesFrance() : []
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annoucement::class,
        ]);
    }
}
