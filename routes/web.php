<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//get user list route
Route::get('/', [UserController::class, 'index']);

Auth::routes();
//home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//add member route
Route::get('/accura_add_member',  [UserController::class, 'insert']);

//post member route
Route::post('/add_member', [UserController::class, 'create'])->name('add_member');

//Delete user
Route::post('/delete_user/{id}', [UserController::class, 'delete']);

//edit user
Route::get('/userEdit/{id}', [UserController::class, 'edit']);

//update member route
Route::post('/update_member', [UserController::class, 'update'])->name('update_member');
