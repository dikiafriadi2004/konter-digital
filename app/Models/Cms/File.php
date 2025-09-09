<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $fillable = ['filename', 'path', 'mime_type', 'size'];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }
}
