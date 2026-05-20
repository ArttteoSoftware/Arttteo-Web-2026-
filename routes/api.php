<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\TextController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\LandingController;
use App\Http\Controllers\Api\PageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Posts
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

// Portfolios
Route::get('/portfolios', [PortfolioController::class, 'index']);
Route::get('/portfolios/{id}', [PortfolioController::class, 'show']);

// Texts
Route::get('/texts', [TextController::class, 'index']);
Route::get('/texts/{key}', [TextController::class, 'show']);

// Pages
Route::get('/pages', [PageController::class, 'index']);
Route::get('/pages/{name}', [PageController::class, 'show']);

// FAQs
Route::get('/faqs', [FaqController::class, 'index']);

// Landing
Route::get('/landings', [LandingController::class, 'index']);
