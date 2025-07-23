<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Str;

use function Laravel\Prompts\alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'src'=>['required', 'mimes:mp4', 'max:40000'],
            'title'=>'required',
            'descr'=>'required',
            "visibility"=>'required',
        ]);
        $file = $data['src'];
        unset($data['src']);
        $data['src'] = $file->store('uploads', 'public');
        $data['thumbnail'] = 'thumbnail'; //this will contain the thumbnail in the future
        $data['user_id'] = Auth::id();
        $data['slug'] = $this->makeUniqueSlug($data['title']);
        $data['published_at'] = now();
        Post::create($data);
        return redirect()->route('profile.home', ['username' => Auth::user()->name]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = DB::table('posts')->where('slug',$id)->get()->first();
        $isLiked = Likes::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->where('status', 'like')
                        ->first();
        $isDisliked = Likes::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->where('status', 'dislike')
                        ->first();
        
        return view('post.home')->with([
            'id'=>$post->id,
            'title' => $post->title,
            'src'=>$post->src,
            'date'=>$post->published_at,
            'isLiked'=>$isLiked,
            'isDisliked'=>$isDisliked
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function like(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:like,dislike',
            'post_id' => 'required|exists:posts,id',
        ]);

        $validated['user_id'] = Auth::id();

        $exists = Likes::where('user_id', Auth::id())
                        ->where('post_id', $validated['post_id'])
                        ->first();

        if($exists)
        {
            Likes::where('user_id', Auth::id())
                ->where('post_id', $validated['post_id'])
                ->delete();
        }
        else Likes::create($validated);

        return response()->json(['message' => 'Like saved.']);
    }

    private function makeUniqueSlug($title) {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Loop until slug is unique in posts table
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
