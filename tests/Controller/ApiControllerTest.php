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
        $response = '{
    "userId": 1,
    "id": 1,
    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
  }';
        $this->assertStringContainsString($response, $client->getResponse()->getContent());
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
