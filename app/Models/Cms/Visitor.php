<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip',
        'browser',
        'platform',
        'device',
        'location',
        'page',
        'visit_date',
        'hit_count'
    ];
}
