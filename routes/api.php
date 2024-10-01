<?php

use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\OrderController;  
//auth routes start
Route::post('/register', [AuthController::class, 'register']);  
Route::post('/login', [AuthController::class, 'login']);  
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// auth route end

// Medicins Table Routes start
Route::get("/medicines", [MedicineController::class, "index"]);  
Route::get("/medicines/{medicine}", [MedicineController::class, "show"]);  
Route::post("/medicines", [MedicineController::class, "store"])->middleware(["auth:sanctum"]);  
Route::patch("/medicines/{medicine}", [MedicineController::class, "update"])->middleware(["auth:sanctum"]);  
Route::delete("/medicines/{medicine}", [MedicineController::class, "destroy"])->middleware(["auth:sanctum"]);
// Medicins Table Routes end

// favorites routes
Route::post('/favorites', action: [FavoritesController::class, 'store'])->middleware("auth:sanctum");
Route::get('/favorites', [FavoritesController::class, 'index']);
Route::get('/favorites/{favorite}', [FavoritesController::class, 'show']);
//end of favorites route

// Order Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});