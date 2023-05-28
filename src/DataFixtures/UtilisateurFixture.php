<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UtilisateurFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {


            $utilisateur = new Utilisateur();
            $utilisateur->setFirstname($faker->firstName);
            $utilisateur->setLastname($faker->name);
            $utilisateur->setMail($faker->email);
            $utilisateur->setPseudo($faker->userName);
            $utilisateur->setMdp($faker->password);
            # code...
            $manager->persist($utilisateur);
        }


        $manager->flush();
    }
}
