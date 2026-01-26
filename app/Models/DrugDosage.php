<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugDosage extends Model
{
    protected $table="drug_dosages";
    
    function getDateFormat()
    {
        return 'U';
    }
}
