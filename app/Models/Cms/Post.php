<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'category_id',
        'meta_description',
        'meta_keywords',
        'thumbnail',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Cms\Category::class);
    }

    protected static function booted()
    {
        static::forceDeleted(function ($post) {
            if ($post->thumbnail) {
                $path = storage_path('app/public/' . $post->thumbnail);

                if (file_exists($path)) {
                    @unlink($path); // hapus file paksa
                }
            }
        });
    }
}
