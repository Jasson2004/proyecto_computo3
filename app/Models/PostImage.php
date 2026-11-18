<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostImage extends Model
{
    protected $fillable = [
        'post_id',
        'image_path',
        'participant_name',
        'evidence_type',
        'caption',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}