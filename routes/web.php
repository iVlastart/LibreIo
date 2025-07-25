<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/watch/{id}',[PostController::class, 'show'])->name('post.watch');

//create a post
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
});

//like dislike a post
Route::middleware(['auth', 'verified'])->group(function(){
    Route::post('/like', [PostController::class, 'like'])->name('post.like');
});

Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.home');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
