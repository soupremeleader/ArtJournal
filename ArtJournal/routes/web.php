<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TextBlockController;
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

Auth::routes();

Route::get('/pages/index/{number}', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/new', [PageController::class, 'create']);
Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
//Route::resource('textblocks', TextBlockController::class);
Route::post('textblocks/store/{number}', [TextBlockController::class, 'store'])->name('textblocks.store');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
