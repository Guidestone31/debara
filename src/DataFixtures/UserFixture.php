<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserFixture extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin1 = new User();
        $admin1->setEmail('admin1@gmail.com');
        $admin1->setUsername('Admin');
        $admin1->setPassword($this->hasher->hashPassword($admin1, 'admin'));
        $admin1->setRoles(['ROLE_ADMIN']);
        $admin2 = new User();
        $admin2->setEmail('admin2@gmail.com');
        $admin2->setUsername('Admin2');
        $admin2->setPassword($this->hasher->hashPassword($admin2, 'admin'));
        $admin2->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin1);
        $manager->persist($admin2);



        $manager->flush();
    }
}
