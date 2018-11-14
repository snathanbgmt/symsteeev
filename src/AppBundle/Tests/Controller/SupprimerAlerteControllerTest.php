<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SupprimerAlerteControllerTest extends WebTestCase
{
    public function testSupprimeralerte()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimerAlerte/{{id}}');
    }

}
