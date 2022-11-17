<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

//Route::get('/', function () {
//    return view('test.test');
//});

Route::get('/', [TestController::class, 'test'])->name('test');
Route::post('test/store', [TestController::class, 'testStore'])->name('test.store');
Route::get('test/search', [TestController::class, 'testSearch'])->name('test.search');
