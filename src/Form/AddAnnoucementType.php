<?php

namespace App\Form;

use App\Entity\Annoucement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAnnoucementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Product_Name')
            ->add('Product_Category')
            ->add('Product_Price')
            ->add('Product_Description')
            ->add('Product_Image');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annoucement::class,
        ]);
    }
    public function saveData(FormInterface $form, $doctrine)
    {
        $now = new \DateTime('now');

        $task = $form->getData();
        $task->setCreatedAt($now);
        $task->setUpdatedAt($now);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($task);
        $entityManager->flush();
    }
}
