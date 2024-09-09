<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["message", "reply_id", "post_id", "writer_id"];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
