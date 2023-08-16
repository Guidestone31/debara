<?php

namespace App\Tests\Unit;

use App\Entity\Annoucement;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AnnoucementTest extends KernelTestCase
{
    public function getEntity()
    {
        return (new Annoucement())
            ->setNom("Annoucement 1")
            ->setDescription("Vélo à pédale")
            ->setPrice(34000);
    }
    public function testEntityIsOK(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $annoucement = $this->getEntity();


        $error = $container->get('validator')->validate($annoucement);

        $this->assertCount(0, $error);
        //$this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }

    public function namIsInvalid()
    {
        self::bootKernel();

        $container = static::getContainer();

        $annoucement = $this->getEntity();
        $annoucement->setNom('');

        $error = $container->get('validator')->validate($annoucement);

        $this->assertCount(1, $error);
    }
/*
    public function testGetAnnoucement()
    {
        self::bootKernel();

        $container = static::getContainer();

        $annoucement = $this->getEntity();
        $user = static::getContainer()->get('doctrine.orm.entity_manager')->find(User::class, );

        $this->assertTrue(0, "Admin");
    }*/
}
