<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function (Request $request) {
    $posts = Post::where('visibility', 'public')->inRandomOrder()->paginate(12);
    
    if($request->ajax())
    {
        return view('home', compact('posts'))->render();
    }

    return view('home', compact('posts'));
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

//follow a person
Route::middleware(['auth', 'verified'])->group(function (){
    Route::post('/follow', [FollowController::class, 'follow'])->name('profile.follow');
});

Route::get('/profile/{username}/{action?}', [ProfileController::class, 'show'])->name('profile.home');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
