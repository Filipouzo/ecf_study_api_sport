<?php

namespace App\Tests\Functional;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


// vérifier que si connexion en tant que Structure => accès interdit à une page /administrateur
class StructureConnexionTest extends WebTestCase
{
    public function testLoginStructure(): void
    {
        // Appel d'un client qui agit en tant que navigateur
        $client = static::createClient();

        // aller sur la première page de connection
        $crawler = $client->request('GET', '/');

        // Vérifier l'accès à la page
        $this->assertResponseIsSuccessful();

        // vérifier que le titre H2 est bien égal à "Connectez-vous pour accéder à votre compte"
        $this->assertSelectorTextContains('h2', 'Connectez-vous pour accéder à votre compte');

        // récupérer le formumaire qui a le bouton "Se connecter" avec le crawler qui inspecte tout le DOM
        $submitButton = $crawler->selectButton('Se connecter');
        $form = $submitButton->form();

        // rentrer les données de l'utilisateur structure
        $form["email"] = "structure@exemple.com";
        $form["password"] = "structure";

        // soumettre le formulaire
        $client->submit($form);
    
        // Vérifier que le statut de réponse à la rediraction de la page est OK
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        
        // aller sur la page accueil administrateur
        $client->request('GET', '/administrateur/accueil');

        // Vérifier que la réponse à bien le statut 403
        $this->assertEquals(403, $client->getResponse()->getStatusCode(), 'Un utilisateur structure peut accéder à une page administrateur');
    }
}


