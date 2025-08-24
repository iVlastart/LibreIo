<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $usersCount = User::count();
    return view('welcome.welcome')->with(['usersCount'=>$usersCount]);
});

Route::get('/home', function (Request $request) {
    $seed = session()->get('post_seed', rand());
    session(['post_seed' => $seed]);

    $posts = Post::where('visibility', 'public')
                ->inRandomOrder($seed)
                ->paginate(20);
    
    if($request->ajax())
    {
        return view('partials.posts', compact('posts'))->render();
    }

    return view('home.home', compact('posts'));
})->middleware(['auth', 'verified'])->name('home');

Route::get('/search/{query}', [PostController::class, 'search'])->name('post.search')->middleware(['auth', 'verified']);
Route::get('/following', [PostController::class, 'following'])->name('following')->middleware(['auth', 'verified']);

Route::get('/watch/{id}',[PostController::class, 'show'])->name('post.watch');
Route::get('/video/{id}', [PostController::class, 'streamVideo'])->name('video.stream');

//create or delete a post
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
    Route::delete('/delete-post', [PostController::class, 'destroy'])->name('post.delete');
});

//like dislike and save a post
Route::middleware(['auth', 'verified'])->group(function(){
    Route::post('/like', [PostController::class, 'like'])->name('post.like');
    Route::post('/save', [PostController::class, 'save'])->name('post.save');
});

//follow a person and upload a profile picture
Route::middleware(['auth', 'verified'])->group(function (){
    Route::post('/follow', [FollowController::class, 'follow'])->name('profile.follow');
    Route::post('/upload-pfp', [ProfileController::class, 'uploadPfp'])->name('profile.upload.pfp');
});

Route::get('/profile/{username}/{action?}', [ProfileController::class, 'show'])->name('profile.home');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//editor
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/editor', [ProjectController::class, 'index'])->name('editor');
    Route::get('/editor/create', [ProjectController::class, 'create'])->name('editor.create');

    Route::post('editor/create', [ProjectController::class, 'store'])->name('editor.store');
});

require __DIR__.'/auth.php';