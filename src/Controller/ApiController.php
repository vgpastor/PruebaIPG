<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Domain\APICreatePost;
use App\Application\Infrastructure\PostRepositoryInterface;
use App\Services\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ApiController extends AbstractController
{
    public function getAll(PostRepositoryInterface $postRepository): Response
    {
        return new JsonResponse($postRepository->findAll());
    }

    public function create(Request $request, APICreatePost $createPost): Response
    {
        try {
            $createPost->execute($request);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
