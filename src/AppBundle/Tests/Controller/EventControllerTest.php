<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/eventi');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/evento');
    }

    public function testPast()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/eventi-passati');
    }

}
