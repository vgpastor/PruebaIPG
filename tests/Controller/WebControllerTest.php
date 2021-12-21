<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebControllerTest extends WebTestCase
{
    public function testGetAll(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('article')->count());
    }

    public function testGetDetail(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Author', $crawler->filter('div#author > h2')->text());
    }
}
