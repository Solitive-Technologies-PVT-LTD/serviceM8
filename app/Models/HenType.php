<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HenType extends Model
{
    use HasFactory;
    protected $table="hentypes";
    
    function getDateFormat()
    {
        return 'U';
    }
}
