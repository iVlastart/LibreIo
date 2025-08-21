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
use Illuminate\Support\Facades\Response;
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
            'src'=>['required', 'mimes:mp4,mov', 'max:5120000'],
            'title'=>'required',
            'descr'=>'required',
            "visibility"=>'required',
            'thumbnail'=>['nullable', 'mimes:jpg,jpeg,png,webp']
        ]);
        $data['slug'] = $this->makeUniqueSlug($data['title']);
        unset($data['src']);
        $reqFile = $request->file('src');
        $outputDir = storage_path('app/public/uploads/'.$data['slug']);
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $fileNameWithoutExt = pathinfo($reqFile->getClientOriginalName(), PATHINFO_FILENAME);
        $finalname = $fileNameWithoutExt.'.mp4';
        $reqFile->move($outputDir, $finalname);

        $data['src'] = 'uploads/'.$data['slug'].'/'.$finalname;
        
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
            $inputPath = storage_path('app/public/'.$data['src']);
            $imgPath = storage_path('app/public/uploads/' . $data['slug'].'/'.$data['slug'].'-preview.webp');
            exec('ffmpeg -i '.escapeshellarg($inputPath).' -vframes 1 -q:v 90 '.escapeshellarg($imgPath).' 2>&1', $output);
            $data['thumbnail'] = 'uploads/' . $data['slug'].'/'.$data['slug'].'-preview.webp';
        }


        $data['src'] = 'uploads/' . $data['slug']. '/'.$fileNameWithoutExt.'.mp4';
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

    public function streamVideo($id, Request $request)
    {  
        $src = Post::where('id', $id)->pluck('src')->first();
		$path = storage_path('app/public/'.$src);

        if (!file_exists($path)) abort(404);

        $size = filesize($path);
        $stream = fopen($path, 'rb'); // use 'rb' for binary
        $resp_code = 200;
        $headers = [
            'Content-Type' => 'video/mp4', // correct MIME type
            'Accept-Ranges' => 'bytes',
        ];

        // Handle Range requests for streaming
        $range = $request->header('Range');
        if ($range) 
        {
            list(, $range) = explode('=', $range, 2);
            $range = explode('-', $range);
            $start = intval($range[0]);
            $end = $range[1] !== '' ? intval($range[1]) : $size - 1;

            fseek($stream, $start);

            $length = $end - $start + 1;
            $resp_code = 206;

            $headers['Content-Range'] = "bytes $start-$end/$size";
            $headers['Content-Length'] = $length;
        } 
        else 
        {
            $headers['Content-Length'] = $size;
        }

        // This will stream in the browser
        return response()->stream(function () use ($stream) {
            fpassthru($stream);
        }, $resp_code, $headers);
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
