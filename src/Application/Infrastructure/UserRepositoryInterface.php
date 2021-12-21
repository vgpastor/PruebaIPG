<?php

declare(strict_types=1);

namespace App\Application\Infrastructure;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
}
