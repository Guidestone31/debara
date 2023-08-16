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
        $this->assertSelectorTextContains('h1', 'Inscription');

        //$message = "succes";

        // Récupérer le formulaire
        $submitButton = $crawler->selectButton('Ajouter');
        $form = $submitButton->form();

        $form["user[username]"] = "Fred";
        $form["user[Name]"] = "Fred";
        $form["user[LastName]"] = "Fredgmailfr";
        $form["user[Phone]"] = "Fred à la montagne";
        $form["user[Adresse]"] = "Fred";
        $form["user[Password][first]"] = "Fred";
        $form["user[Password][second]"] = "Fred";
        $form["user[Email]"] = "Fred@gmail.fr";

        // Soummettre le formulaire

        $client->submit($form);
        // Verifier le statut Http

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Vérifier l'envoie de mail

        //$this->assertEmailCount(0);

        //$client->followRedirect();

        // Verifier la presence du message

        /*$this->assertSelectorTextContains(
            '.div.alert.alert-success',
            'Votre profil a bien été ajouté'
        );*/
    }
}
