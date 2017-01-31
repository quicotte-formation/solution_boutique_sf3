<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SolutionFiltreControllerTest extends WebTestCase
{
    public function testSolutionfiltre()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/solutionFiltre');
    }

}
