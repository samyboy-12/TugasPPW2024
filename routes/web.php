<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\GreetController;



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



Route::middleware(['auth','age.check',])->group(function () {
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book', [BookController::class, 'store'])->name('book.store');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
    Route::post('/book/{id}/upload', [BookController::class, 'upload'])->name('book.upload');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::get ('/send-email', [SendEmailController :: class, 'index' ] ) ->name ('kirim-email');
    Route::post ('/post-email', [SendEmailController ::class, 'store' ] ) ->name ('post-email' ) ;
    Route::get('/info', [InfoController::class, 'index'])->name('info');
    Route::get('/greet', [GreetController::class,'greet'])->name('greet');

    Route::get('/about', function () {
        return view('about');
    })->name('about');
    Route::get('/home', 'HomeController@index')->name('home');
});



Route::middleware(['admin'])->group(function () {
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book', [BookController::class, 'store'])->name('book.store');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::post('/book/{id}/upload', [BookController::class, 'upload'])->name('book.upload');
    
});
Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');

