<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ApiController extends AbstractController
{
    public function getAll(): Response
    {
        $response = '{
    "userId": 1,
    "id": 1,
    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
  }';

        return new Response($response, Response::HTTP_OK, ['content-type' => 'application/json']);
    }

    public function create(): Response
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
