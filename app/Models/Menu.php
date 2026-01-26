<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $incrementing = true;
    protected  $fillable = [
        'title',
        'display_name',
        'description',
        'parent_id',
        'super_admin',
        'permission',
        'route_name',
        'active',
        'icon',
        'order'

    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    public function childrenRecursive()
    {
        return $this->hasMany(self::class, 'parent_id')->with('childrenRecursive');
    }
}