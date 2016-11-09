<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhotoControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/foto');
    }

    public function testAlbum()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/album');
    }

}
