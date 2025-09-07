<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';

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

    protected $casts = [
        'visit_date' => 'date',
        'hit_count'  => 'integer',
    ];

    /**
     * Menentukan unique constraint secara logika:
     * Setiap kombinasi ip + page + visit_date hanya boleh ada satu record.
     * Idealnya juga dibuat di migration sebagai unique index:
     * $table->unique(['ip', 'page', 'visit_date']);
     */
}
