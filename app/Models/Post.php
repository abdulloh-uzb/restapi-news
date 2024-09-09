<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory, SoftDeletes;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model): void {
            $model->slug = Str::slug($model->title_uz);
        });
    }
}
