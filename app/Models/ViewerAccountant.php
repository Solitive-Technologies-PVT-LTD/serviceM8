<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerAccountant extends Model
{
    
    protected $table="viewer_accountant";
    
    function getDateFormat()
    {
        return 'U';
    }
}
