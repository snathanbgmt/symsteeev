<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class supprimerContributionControllerTest extends WebTestCase
{
    public function testSupprimercontribution()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimerContribution/{id}');
    }

}
