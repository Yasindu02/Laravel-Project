<?php

use App\Http\Controllers\BookController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(BookController::class)->prefix('bookdetails')->group(function () {
    route::get('addbook','add')->name('bookdetails.addbook');
    route::post('addbook','store')->name('bookdetails.addbook');
    route::get('index','index')->name('bookdetails.index');
    route::get('destroy/{id}','bookDestroy')->name('bookdetails.destroy');

    Route::get('/bookdetails/edit/{id}','edit')->name('bookdetails.editbook');
    Route::post('/bookdetails/update/{id}',  'update')->name('bookdetails.update');

});