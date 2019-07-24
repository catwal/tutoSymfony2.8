<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class templateControllerTest extends WebTestCase
{
    public function testDisplaytwig()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/displayTwig');
    }

}
