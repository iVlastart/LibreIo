<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Follow;
use App\Models\Post;
use App\Models\Saves;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }


        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(Request $request, $username, $action = "")
    {
        $user = User::where('name', $username)->first();
        $authUser = User::where('name', Auth::user()->name)->first();
        $videosCount = Post::where('user_id', $user->id)->count();
        switch($action)
        {
            case "private":
                if ($user->name === Auth::user()->name) {
                    $posts = Post::orderBy('published_at', 'desc')
                                ->where('user_id', $user->id)
                                ->where('visibility', 'private')
                                ->paginate(40);
                } else {
                    $posts = new LengthAwarePaginator([], 0, 8, 1); // empty paginator
                }
                break;
            case 'saved':
                    if ($user->name === Auth::user()->name) {
                        $savedPostIDs = Saves::where('user_id', Auth::id())->pluck('post_id');
                        $posts = Post::orderBy('published_at', 'desc')
                                    ->whereIn('id', $savedPostIDs)
                                    ->paginate(40);
                    } else {
                        $posts = new LengthAwarePaginator([], 0, 8, 1);
                    }
                break;
            default:
                $posts = Post::orderBy('published_at', 'desc')->where('user_id', $user->id)->where('visibility', 'public')->paginate(40);
                break;
        }
        if($request->ajax())
        {
            return view('partials.posts', compact('posts'))->render();
        }
        return view('profile.home', [
                        'videosCount' => $videosCount,
                        'username' => $username,
                        'action' => $action,
                        'followersCount' => Follow::where('followed_id', $user->id)->count(),
                        'followingCount' => Follow::where('follower_id', $user->id)->count(),
                        'bio' => $user->bio,
                        'pfp' => $user->pfp,
                        'isFollowed'=>Follow::where('follower_id', $authUser->id)->where('followed_id', $user->id)->first()!==null,
                        'posts'=>$posts
                    ]);
    }

    public function uploadPfp(Request $request)
    {
        $request->validate([
            'pfp'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::find(Auth::id());
        $data['pfp'] = $user->pfp ?? null;
        if($data['pfp']!==null)
        {
            Storage::disk('public')->delete($data['pfp']);
        }
        $pfp = $request->file('pfp');
        if($pfp)
        {
            $pfpPath = $pfp->store('profile/'.Auth::user()->name, 'public');
        }
        $data['pfp'] = $pfpPath;

        
        $user->pfp = $data['pfp'];
        $user->save();
    }
}
