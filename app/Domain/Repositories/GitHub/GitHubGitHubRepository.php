<?php

namespace App\Domain\Repositories\GitHub;

use App\Domain\Entities\Repository;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

readonly class GitHubGitHubRepository implements GitHubRepositoryInterface
{
    public function __construct(private string $token, private string $username)
    {
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    public function create(string $name): Repository
    {
        $response = Http::withToken($this->token)->post('https://api.github.com/user/repos', [
            'name' => $name,
            'private' => false,
        ]);

        if ($response->successful()) {
            $repoData = $response->json();

            \App\Models\Repository::query()->create([
                'name' => $name,
                'url' => $repoData['url'],
                'owner_id' => Auth::user()->id, // todo: need authentication
                'created_at' => now(),
            ]);

            return new Repository($repoData['id'], $repoData['name'], $repoData['url'], $repoData['created_at']);
        }

        throw new Exception('Failed to create repository: ' . $response->body());
    }

    /**
     * @throws ConnectionException
     */
    public function delete(string $name): bool
    {
        $response = Http::withToken($this->token)->delete("https://api.github.com/repos/{$this->username}/{$name}");

        \App\Models\Repository::query()->where([
            'owner_id' => Auth::user()->id, // todo: need authentication
            'name' => $name,
        ])->delete();

        return $response->successful();
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    public function all(array $parameters): array
    {
        $username = $parameters['username'] ?? $this->username;
        $response = Http::withToken($this->token)->get("https://api.github.com/users/{$username}/repos");

        if ($response->successful()) {
            return array_map(function ($repo) {
                return new Repository($repo['id'], $repo['name'], $repo['url'], $repo['created_at']);
            }, $response->json());
        }

        throw new Exception('Failed to fetch repositories: ' . $response->body());
    }
}
