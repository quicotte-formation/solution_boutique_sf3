<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testFirewall()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/firewall');
    }

}
