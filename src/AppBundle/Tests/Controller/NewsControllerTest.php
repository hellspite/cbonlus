<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/post');
    }

}
