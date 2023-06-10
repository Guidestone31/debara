<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            //->add('roles')
            ->add('Email')
            ->add('password', PasswordType::class)
            ->add('Ajouter', SubmitType::class);
        //->add('passwordConfirm', PasswordType::class)
        //->add('plainPassword', PasswordType::class, [
        //'hash_property_path' => 'password',
        //'mapped' => false,
        //]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
