<?php

namespace App\Tests\Fonctional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
}
