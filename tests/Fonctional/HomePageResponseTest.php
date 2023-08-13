<?php

namespace App\Tests\Fonctional;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomePageTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();


        $button = $crawler->filter('.btn.btn-primary.btn-lg.active');
        $this->assertEquals(1, count($button));

        $this->assertSelectorTextContains('h1', 'Acceuil');
    }
    public function testloginUser(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $button = $crawler->filter('.btn.btn-primary.btn-lg.active');
        $this->assertEquals(1, count($button));

        $this->assertSelectorTextContains('h1', 'Acceuil');
    }
}
