<?php

namespace App\Providers;

use App\Domain\Repositories\GitHub\GitHubGitHubRepository;
use App\Domain\Repositories\GitHub\GitHubRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GitHubRepositoryInterface::class, function ($app) {
            return new GitHubGitHubRepository(env('GITHUB_TOKEN'), env('GITHUB_USERNAME'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
