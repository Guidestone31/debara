<?php

namespace App\Form;

use App\Entity\Annoucement;
use App\Entity\Departements;
use App\Entity\Regions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\File;

class AddAnnoucementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /* ->add('name')
            ->add('SubCategoryOne')*/
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
            /*->add('Departements', EntityType::class, [
                'placeholder' => 'Départements (choisir une région)',
                'mapped' => false,
                'class' => Departements::class,
                'choice_label' => 'nom',
                'label' => 'Départements'
            ])*/

            ->add('departements', ChoiceType::class, [
                'placeholder' => 'Département (choisir une région)',
                'required' => false

            ])
            ->add('Ajouter', SubmitType::class);

        $formModifier = function (FormInterface $form, Regions $region = null) {
            $departement = null === $region ? [] : $region->getDepartements();

            $form->add('departements', EntityType::class, [
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
            function (FormEvent $event) use ($formModifier) {
                $region = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $region);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annoucement::class,
        ]);
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
}
