<?php

declare(strict_types=1);

namespace App\Application\Domain;

use App\Application\Infrastructure\PostRepositoryInterface;
use App\Entity\Post;
use App\Entity\User;

final class CreatePost
{
    private PostRepositoryInterface $postRepository;

    private PostBodyValidator $postBodyValidator;

    public function __construct(PostRepositoryInterface $postRepository, PostBodyValidator $postBodyValidator)
    {
        $this->postRepository = $postRepository;
        $this->postBodyValidator = $postBodyValidator;
    }

    public function execute(User $author, string $title, string $body): Post
    {
        $body = $this->postBodyValidator->execute($body);

        $post = new Post();
        $post->setAuthor($author);
        $post->setTitle($title);
        $post->setBody($body);
        $this->postRepository->save($post);

        return $post;
    }
}
