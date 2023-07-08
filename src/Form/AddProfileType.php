<?php

namespace App\Form;

use App\Entity\Annoucement;
use App\Entity\Profile;
use App\Form\UserType;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AddProfileType extends AbstractType
{
    // FormType
    /*
    public function __construct(private readonly MySweetService $mySweetService)
    {

        $builder->addEventSubscriber(
            subscriber: new TotoSubscriber(
                mySweetService: $mySweetService
            )
        );
    }*/

    // Subscriber

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FirstName')
            ->add('LastName')
            ->add('PhoneNumber')
            //->add('username')
            //->add('Email')
            //->add('password', PasswordType::class)
            //->add('passwordConfirm', PasswordType::class)
            ->add('Adress')
            ->add('Picture', FileType::class, [
                'label' => 'Photo de profil',
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
            ]);
        $builder->add('user', UserType::class);
        /*
        ->add('UserId', EntityType::class, [
            'class' => User::class,
            'label' => 'Pseudo',
            ])
            ->add('password', EntityType::class, [
                'mapped' => false,
                'class' => User::class,
                'choice_label' => 'password',
                'placeholder' => 'Mot de pass',
                'label' => 'Mot de passe',
                'required' => false
                ])

                ->add('Email', EntityType::class, [
                    'mapped' => false,
                    'class' => User::class,
                    'choice_label' => 'Email',
                    'placeholder' => 'Email',
                    'label' => 'Email',
                    'required' => false
                    ])
                    */
        //->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
            'cascade_validation' => true,
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
