<?php

namespace App\Http\Controllers;

use App\Application\Services\GitHubService;
use App\Http\Resources\GitHub\GitHubRepositoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GitHubController extends Controller
{
    protected GitHubService $gitHubService;

    public function __construct(GitHubService $gitHubService)
    {
        $this->gitHubService = $gitHubService;
    }

    /**
     * @OA\Get(
     *     path="/api/repositories",
     *     summary="List all repositories",
     *     tags={"Repositories"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of repositories",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Repository"))
     *     ),
     *     @OA\Response(response=500, description="Error fetching repositories")
     * )
     */
    public function list(Request $request): AnonymousResourceCollection
    {
        $repositories = $this->gitHubService->list($request->all());
        return GitHubRepositoryResource::collection($repositories);
    }
}
