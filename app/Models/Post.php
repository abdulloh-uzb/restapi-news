<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title_uz",
        "title_ru",
        "body_uz",
        "body_ru",
        "image",
        "slug",
        "tags",
        "category_id"
    ];


}
