<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Infrastructure\PostRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class WebController extends AbstractController
{
    public function getAll(PostRepositoryInterface $postRepository): Response
    {
        return new Response(
            $this->renderView('all.html.twig', [
                'posts' => $postRepository->findAll(),
            ])
        );
    }

    public function getDetail(int $id, PostRepositoryInterface $postRepository): Response
    {
        return new Response(
            $this->renderView('detail.html.twig', [
                'post' => $postRepository->findId($id),
            ])
        );
    }
}
