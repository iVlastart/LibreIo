<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function follow(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|exists:users,name'
        ]);

        $authID = Auth::id();
        $user = User::where('name', $validated['name'])->first();

        //if the users do not follow each other
        if(Follow::where('follower_id', $authID)->where('followed_id', $user->id)->first()===null)
        {
            Follow::create([
                'follower_id' => $authID,
                'followed_id' => $user->id,
            ]);
        }
        //if the users follow each other
        else
        {
            Follow::where('follower_id', $authID)->where('followed_id', $user->id)->delete();
        }
    }
}
