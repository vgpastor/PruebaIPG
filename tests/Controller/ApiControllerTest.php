<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/post');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $response = '{"id":1,"title":"Post #0","body":"This is my 0 blog post!","author":{';
        if (false !== $client->getResponse()->getContent()) {
            $this->assertStringContainsString($response, $client->getResponse()->getContent());
        }
    }

    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/api/post', [
            'title' => 'test',
            'body' => 'test',
        ], [], [
            'CONTENT_TYPE' => 'application/json',
            'Authorization' => 'Bearer asdf',
        ]);
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
