<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
class Setting extends Model
{
    public $incrementing = true;
    // use SoftDeletes;

    function getDateFormat()
    {
        return 'U';
    }
    
    
}
