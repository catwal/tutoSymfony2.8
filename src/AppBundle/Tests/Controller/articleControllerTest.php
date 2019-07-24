<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class articleControllerTest extends WebTestCase
{
    public function testListarticles()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listArticles');
    }

}
