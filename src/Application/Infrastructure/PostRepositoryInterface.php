<?php

declare(strict_types=1);

namespace App\Application\Infrastructure;

use App\Entity\Post;

interface PostRepositoryInterface
{
    public function findAll(): array;

    public function save(Post $post): void;
}
