<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SolutionsDQLControllerTest extends WebTestCase
{
    public function testEx1()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ex1');
    }

}
