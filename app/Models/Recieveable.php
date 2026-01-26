<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recieveable extends Model
{
    
    protected $table="recieveable";
    
    function getDateFormat()
    {
        return 'U';
    }
}
