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

    public function testCreateInvalidLengthChars(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/api/post', [
            'title' => 'test',
            'body' => 'test',
        ], [], [
            'CONTENT_TYPE' => 'application/json',
            'Authorization' => 'Bearer asdf',
        ]);
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        if (false !== $client->getResponse()->getContent()) {
            $this->assertStringContainsString("JWT Token  it\u0027s required", $client->getResponse()->getContent());
        }
    }

    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/api/post', [
            'title' => 'test',
            'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_Authorization' => 'Bearer asdf',
        ]);
        var_dump($client->getResponse()->getContent());
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
