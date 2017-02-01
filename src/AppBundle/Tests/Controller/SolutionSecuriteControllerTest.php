<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SolutionSecuriteControllerTest extends WebTestCase
{
    public function testSecu1()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/secu1');
    }

    public function testSecu2()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/secu2');
    }

    public function testAdminsecu3()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/adminSecu3');
    }

    public function testAdminsecu4()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/adminSecu4');
    }

}
