<?php
//Start_Controller_Import

use App\Http\Controllers\Auth\GithubAuthController;
use App\Http\Controllers\Auth\GoogleController;

//End_Controller_Import


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/auth/google' , [GoogleController::class , 'redirect'])->name('auth.google');
Route::get('/auth/google/callback' , [GoogleController::class , 'callback']);

Route::get('/auth/github',[GithubAuthController::class , 'redirect'])->name('auth.github');
Route::get('/auth/github/callback',[GithubAuthController::class , 'callback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('secret',function ()
{
    return 'secret';
})->middleware(['auth','password.confirm']);
