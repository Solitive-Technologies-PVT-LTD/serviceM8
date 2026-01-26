<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class SpatiePermission extends Permission
{
    public $incrementing = true;
    function getDateFormat()
    {
        return 'U';
    }
    public function parent()
    {
        return $this->belongsTo(SpatiePermission::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(SpatiePermission::class, 'parent_id');
    }
    
}