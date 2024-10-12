<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

Route::get('/docs', function () {
    return redirect('/api/documentation');
});

Route::get('/repositories', [GitHubController::class, 'list']);
