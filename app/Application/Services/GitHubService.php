<?php

namespace App\Application\Services;

use App\Domain\Entities\Repository;
use App\Domain\Repositories\GitHub\GitHubRepositoryInterface;

class GitHubService
{
    protected GitHubRepositoryInterface $repository;

    public function __construct(GitHubRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  string  $name
     *
     * @return Repository
     */
    public function createRepository(string $name): Repository
    {
        return $this->repository->create($name);
    }

    /**
     * @param  string  $name
     *
     * @return bool
     */
    public function deleteRepository(string $name): bool
    {
        return $this->repository->delete($name);
    }

    /**
     * @param  array  $parameters
     *
     * @return array
     */
    public function list(array $parameters): array
    {
        return $this->repository->all($parameters);
    }
}
