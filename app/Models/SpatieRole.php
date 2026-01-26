<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class SpatieRole extends \Spatie\Permission\Models\Role
{
    public $incrementing = true;
    function getDateFormat()
    {
        return 'U';
    }
}