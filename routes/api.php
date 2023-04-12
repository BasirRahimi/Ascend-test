<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LibraryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Routes for the Book Model
 * Be sure to prefix '/api' to api requests
 * 
 * The books can only be manipulated by an admin.
 */
Route::controller(BookController::class)->group(function () {
    Route::get('/books/{id?}', 'index');
    Route::post('/books/create', 'store');
    Route::put('/books/{id}', 'update');
    Route::delete('/books/{id}', 'destroy');
})->middleware(['auth', 'is.admin']);

/**
 * Routes for the Library Model
 */
Route::controller(LibraryController::class)->group(function () {
    Route::post('/library/borrow', 'borrowBook');
    Route::post('/library/return', 'returnBook');
})->middleware(['auth', 'verified']);
