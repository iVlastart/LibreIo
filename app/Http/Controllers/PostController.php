<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Likes;
use App\Models\Post;
use App\Models\Saves;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'thumbnail'=>['nullable', 'mimes:jpg,jpeg,png,webp']
        ]);
        $data['slug'] = $this->makeUniqueSlug($data['title']);
        $file = $request->file('src');
        $filename = $file->getClientOriginalPath();
        $dirPath = storage_path('app/public/uploads/' . $data['slug']);

        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0755, true);
        }
        $path = $dirPath . '/' . $filename;
        $file->move($dirPath, $filename);

        $vidOutput = [];
        exec('ffmpeg -i '.escapeshellarg($filename).' -c copy -movflags faststart '.escapeshellarg($path).' 2>&1', $vidOutput);

        $thumbnail = $request->file('thumbnail');

        if($thumbnail)
        {
            //thumbnail was provided
            $imgPath = $thumbnail->store(
                'uploads/'.$data['slug'],
                'public'
            );
            $data['thumbnail'] = $imgPath;
        }
        else
        {
            //thumbnail was not provided thus thumbnail will be the 1st frame
            $output = [];
            $vidPath = storage_path('app/public/uploads/' . $data['slug']. '/'.$filename);
            $imgPath = storage_path('app/public/uploads/' . $data['slug'].'/'.$data['slug'].'-preview.webp');
            exec('ffmpeg -i '.escapeshellarg($vidPath).' -vframes 1 -q:v 90 '.escapeshellarg($imgPath).' 2>&1', $output);
            $data['thumbnail'] = 'uploads/' . $data['slug'].'/'.$data['slug'].'-preview.webp';
        }


        $data['src'] = 'uploads/' . $data['slug'] . '/' . $filename;
        $data['user_id'] = Auth::id();
        
        $data['published_at'] = now();

        Post::create($data);
        return redirect()->route('profile.home', ['username' => Auth::user()->name]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $post = DB::table('posts')->where('slug',$id)->get()->first();
        $user = DB::table('users')->where('id', $post->user_id)->get()->first();
        if($post->visibility==='private'
            && Auth::user()->name!==$user->name)
        {
            return redirect('home');
        }
        $ip = $request->ip();

        $alreadyViewed = DB::table('Views')
                            ->where('post_id', $post->id)
                            ->where(function($query) use ($ip) {
                                $query->where('user_id', Auth::id())
                                    ->orWhere('ip_address', $ip);
                            })
                            ->exists();
        if (!$alreadyViewed) {
            DB::table('Views')->insert([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
                'ip_address' => $ip,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $isLiked = Likes::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->where('status', 'like')
                        ->first();
        $isDisliked = Likes::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->where('status', 'dislike')
                        ->first();
        $isSaved = Saves::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->first();
        $likeCount = Likes::where('post_id', $post->id)->where('status', 'like')->count();
        $dislikeCount = Likes::where('post_id', $post->id)->where('status', 'dislike')->count();
        $followers = Follow::where('followed_id', $user->id)->count();
        return view('post.home')->with([
            'id'=>$post->id,
            'title' => $post->title,
            'description'=>$post->descr,
            'src'=>$post->src,
            'date'=>$post->published_at,
            'isLiked'=>$isLiked,
            'isDisliked'=>$isDisliked,
            'isSaved'=>$isSaved,
            'likeCount'=>$likeCount,
            'dislikeCount'=>$dislikeCount,
            'username'=>$user->name,
            'pfp'=>$user->pfp,
            'followers'=>$followers,
            'isFollowed'=>Follow::where('follower_id', Auth::id())->first()!==null,
            'views'=>DB::table('Views')->where('post_id', $post->id)->count()
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

    public function save(Request $request)
    {
        $validated = $request->validate([
            'post_id'=>'required|exists:posts,id'
        ]);
        
        $validated['user_id'] = Auth::id();

        $exists = Saves::where('user_id', Auth::id())
                        ->where('post_id', $validated['post_id'])
                        ->first();

        if($exists)
        {
            Saves::where('user_id', Auth::id())
                ->where('post_id', $validated['post_id'])
                ->delete();
        }

        else Saves::create($validated);
    }

    public function search(string $query, Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $query . '%')->paginate(20);

        if($request->ajax())
        {
            return view('partials.posts', compact('posts'))->render();
        }
        return view('home.search', compact('posts'))->with([
            'query' => $query,
        ])->render();
    }

    public function following(Request $request)
    {
        $seed = session()->get('post_seed', rand());
        session(['post_seed' => $seed]);
        $followedUsers = Follow::where('follower_id', Auth::id())
            ->pluck('followed_id');

        $posts = Post::whereIn('user_id', $followedUsers)
            ->where('visibility', 'public')
            ->inRandomOrder($seed)
            ->paginate(20);

        if($request->ajax())
        {
            return view('partials.posts', compact('posts'))->render();
        }
        return view('home.following', compact('posts'))->render();
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
