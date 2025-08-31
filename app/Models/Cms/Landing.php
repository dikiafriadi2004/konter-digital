<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    protected $table = 'landing';
    protected $fillable = [
        'title',
        'subtitle',
        'cta_google_play',
        'image',
    ];
}
