<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flock extends Model
{
    use HasFactory;
    protected $table="flock";
    
    function getDateFormat()
    {
        return 'U';
    }
}
