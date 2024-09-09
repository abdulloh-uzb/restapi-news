<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name_uz",
        "name_ru",
        "slug"
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }




    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model): void {
            $model->slug = Str::slug($model->name_uz);
        });
    }
}
