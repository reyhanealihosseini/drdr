<?php

namespace Tests\Feature;

use App\Application\Services\GitHubService;
use App\Domain\Repositories\GitHub\GitHubGitHubRepository;
use Tests\TestCase;

class GitHubServiceTest extends TestCase
{
    protected GitHubService $gitHubService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gitHubService = new GitHubService(new GitHubGitHubRepository(env('GITHUB_TOKEN'), env('GITHUB_USERNAME')));
    }

    public function test_can_list_repositories()
    {
        $repositories = $this->gitHubService->list([]);
        $this->assertIsArray($repositories);
    }
}
