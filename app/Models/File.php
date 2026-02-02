<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'folder_id',
        'name',
        'path',
        'mime_type',
        'size',
        'company_uuid'
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
