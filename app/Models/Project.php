<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'original_files',
        'audio_files',
        'image_files',
        'timeline_data',
        'effects_data',
        'output_file',
        'resolution',
        'format',
        'duration',
        'size',
        'thumbnail',
    ];
}
