<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        "follower_id",
        "followed_id"
    ];

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follow', 'follower_id', 'followed_id')->withTimestamps();
    }
}
