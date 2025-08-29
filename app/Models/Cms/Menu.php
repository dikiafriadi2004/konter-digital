<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'type', 'url', 'parent_id', 'order'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
