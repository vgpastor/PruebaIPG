<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostRepository;
use App\Services\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ApiController extends AbstractController
{
    public function getAll(PostRepository $postRepository): Response
    {
        return new JsonResponse($postRepository->findAll());
    }

    public function create(): Response
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
