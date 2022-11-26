<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('create-account', [AuthController::class, 'createAccount']);
Route::post('sign-in', [AuthController::class, 'signIn']);
Route::post('sign-out', [AuthController::class, 'signOut']);
Route::get('get-users',[AuthController::class, 'getUsers']);
Route::get('get-users/{profile}',[AuthController::class, 'getUsersProfile']);
Route::delete('del-users/{id}',[AuthController::class, 'delUsersProfile']);



Route::get('get-products',[ProductController::class, 'getProducts']);
Route::post('create-product', [ProductController::class, 'createProduct']);
Route::delete('del-product/{id}',[ProductController::class, 'delProduct']);



Route::get('get-clubs',[ClubController::class, 'getClubs']);
Route::get('get-clubs/{email}',[ClubController::class, 'getUsersClub']);
Route::post('create-club', [ClubController::class, 'createClub']);
Route::delete('del-club/{id}',[ClubController::class, 'delClub']);



Route::post('create-orders',[OrderController::class, 'addOrder']);
Route::get('get-orders/{email}',[OrderController::class, 'getOrders']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});