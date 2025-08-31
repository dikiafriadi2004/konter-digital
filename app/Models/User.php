<?php

namespace App\Models;

use App\Models\Cms\Post;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = ['name', 'email', 'username', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected static function booted()
    {
        static::deleting(function ($user) {
            if (! $user->isForceDeleting()) {
                foreach ($user->posts as $post) {
                    $post->delete();
                }
                Log::info("User {$user->id} soft deleted → semua posts ikut soft delete.");
            }
        });

        static::restoring(function ($user) {
            $user->posts()->withTrashed()->restore();
            Log::info("User {$user->id} restored → semua posts ikut restore.");
        });

        static::forceDeleted(function ($user) {
            $allPosts = Post::withTrashed()->where('user_id', $user->id)->get();

            foreach ($allPosts as $post) {
                if ($post->thumbnail) {
                    $path = storage_path('app/public/' . $post->thumbnail);
                    if (file_exists($path)) {
                        @unlink($path); // hapus file paksa
                    }
                }
                $post->forceDelete();
                Log::info("Post {$post->id} milik User {$user->id} dihapus permanen.");
            }

            Log::info("User {$user->id} force deleted permanen.");
        });
    }
}
