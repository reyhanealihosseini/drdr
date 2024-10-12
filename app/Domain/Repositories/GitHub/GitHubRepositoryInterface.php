<?php

namespace App\Domain\Repositories\GitHub;

use App\Domain\Entities\Repository;

interface GitHubRepositoryInterface
{
    public function create(string $name): Repository;
    public function delete(string $name): bool;
    public function all(array $parameters): array;
}
