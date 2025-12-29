<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Landing Page Routes
Route::get('/landing', [LandingPageController::class, 'show']); // Public landing page
Route::get('/landing/preview', [LandingPageController::class, 'preview']);
Route::post('/landing/save', [LandingPageController::class, 'save']);

// Page Content Route
Route::get('/page/{slug}', [PageController::class, 'getPageContent']);
