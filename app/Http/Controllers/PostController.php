<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Str;

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
        return view('post.home')->with([
            'title' => $post->title,
            'src'=>$post->src
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
