<?php

namespace App\Tests\Fonctional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends WebTestCase
{
    public function testSomethingO(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertSelectorTextContains('h1', '');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorNotExists(
            '.alert.alert-danger'
        );
    }
    public function testAddAnnouceAuth(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');


        $form = $crawler->selectButton('Se connecter')->form([

            'username' => 'lol',
            //'email' => 'admin1@gmail.com',
            'password' => 'lol'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Login');
        $this->assertSelectorExists(
            '.alert.alert-danger'
        );
    }
    public function testSuccessfullogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');


        $form = $crawler->selectButton('Se connecter')->form([

            'username' => 'Admin',
            //'email' => 'admin1@gmail.com',
            'password' => '$2y$13$IrEkLKrSrJnubLfIK2NbF.WO9XbETrZIb0aN4JA88YUZj5ae63jFO'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect();

        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
        //$this->assertSelectorTextContains('h1', 'Login');
        /*$this->assertSelectorExists(
            '.alert.alert-success'
        );*/
    }
}
