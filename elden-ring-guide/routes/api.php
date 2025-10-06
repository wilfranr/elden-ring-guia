<?php

use App\Http\Controllers\Api\AmmoController;
use App\Http\Controllers\Api\ArmorController;
use App\Http\Controllers\Api\AshController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\CreatureController;
use App\Http\Controllers\Api\IncantationController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\NpcController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ShieldController;
use App\Http\Controllers\Api\SorceryController;
use App\Http\Controllers\Api\SpiritController;
use App\Http\Controllers\Api\TalismanController;
use App\Http\Controllers\Api\WeaponController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BossController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('bosses', BossController::class)->only(['index', 'show']);
Route::apiResource('items', ItemController::class)->only(['index', 'show']);
Route::apiResource('ammos', AmmoController::class)->only(['index', 'show']);
Route::apiResource('armors', ArmorController::class)->only(['index', 'show']);
Route::apiResource('ashes', AshController::class)->only(['index', 'show']);
Route::apiResource('classes', ClassController::class)->only(['index', 'show']);
Route::apiResource('creatures', CreatureController::class)->only(['index', 'show']);
Route::apiResource('incantations', IncantationController::class)->only(['index', 'show']);
Route::apiResource('locations', LocationController::class)->only(['index', 'show']);
Route::apiResource('npcs', NpcController::class)->only(['index', 'show']);
Route::apiResource('shields', ShieldController::class)->only(['index', 'show']);
Route::apiResource('sorceries', SorceryController::class)->only(['index', 'show']);
Route::apiResource('spirits', SpiritController::class)->only(['index', 'show']);
Route::apiResource('talismans', TalismanController::class)->only(['index', 'show']);
Route::apiResource('weapons', WeaponController::class)->only(['index', 'show']);

Route::get('/regions/{region}', [RegionController::class, 'show']);

Route::get('/search', [SearchController::class, 'search']);
