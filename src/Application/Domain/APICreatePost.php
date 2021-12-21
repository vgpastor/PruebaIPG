<?php

declare(strict_types=1);

namespace App\Application\Domain;

use App\Entity\Post;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

final class APICreatePost
{
    private CreatePost $createPost;
    private UserRepository $userRepository;

    public function __construct(CreatePost $createPost, UserRepository $userRepository)
    {
        $this->createPost = $createPost;
        $this->userRepository = $userRepository;
    }

    public function execute(Request $request): Post
    {
        if (null === $request->get('title')) {
            throw new \RuntimeException('Title is required');
        }
        if (null === $request->get('body')) {
            throw new \RuntimeException('Body is required');
        }
        if (null === $request->headers->get('Authorization')) {
            throw new \RuntimeException('JWT Token  it\'s required');
        }

        // @todo: Obtain the user from the JWT Token
        $author = $this->userRepository->findById(2);
        if (is_null($author)) {
            throw new \RuntimeException('Author not found');
        }

        return $this->createPost->execute($author, $request->get('title'), $request->get('body'));
    }
}
