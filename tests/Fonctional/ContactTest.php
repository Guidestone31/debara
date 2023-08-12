<?php

namespace App\Tests\Fonctional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/Authentification');

        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', '');

        // Récupérer le formulaire
        $submitButton = $crawler->selectButton('Ajouter');
        $form = $submitButton->form();

        $form["user[username]"] = "Fred";
        $form["user[Name]"] = "Fred";
        $form["user[LastName]"] = "Fred@gmail.fr";
        $form["user[Phone]"] = "Fred à la montagne";
        $form["user[Adresse]"] = "Fred";
        $form["user[Password][first]"] = "Fred";
        $form["user[Password][second]"] = "Fred";
        $form["user[Email]"] = "Fred@gmail.fr";

        // Soummettre le formulaire

        $client->submit($form);
        // Verifier le statut Http

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        // Vérifier l'envoie de mail

        $this->assertEmailCount(1);

        $client->followRedirect();

        // Verifier la presence du message

        $this->assertSelectorTextContains(
            'Bienvenue',
            '.div.alert.alert-success'
        );
    }
}
