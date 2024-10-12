<?php

namespace App\Console\Commands;

use App\Application\Services\GitHubService;
use Illuminate\Console\Command;

class DeleteGitHubRepository extends Command
{
    protected $signature = 'delete:github-repository {name}';
    protected $description = 'Delete a repository on GitHub for the authenticated user';

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
            if ($this->gitHubService->deleteRepository($name)) {
                $this->info("Repository '{$name}' deleted successfully.");
            }
            else {
                $this->error("Failed to delete repository '{$name}'.");
            }
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
