<?php

namespace App\Console\Commands;

use App\Application\Services\GitHubService;
use Illuminate\Console\Command;

class CreateGitHubRepository extends Command
{
    protected $signature = 'create:github-repository {name}';
    protected $description = 'Create a repository on GitHub for the authenticated user';

    protected GitHubService $gitHubService;

    public function __construct(GitHubService $gitHubService)
    {
        parent::__construct();
        $this->gitHubService = $gitHubService;
    }

    public function handle(): void
    {
        $name = $this->argument('name');

        try {
            $repository = $this->gitHubService->createRepository($name);
            $this->info("Repository '{$repository->name}' created successfully at {$repository->url}.");
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
