<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'project_id', 'folder_id', 'document_no', 'title', 'file_name', 'file_path',
        'file_type', 'file_size', 'metadata', 'status', 'current_version', 'uploaded_by'
    ];

    protected $casts = ['metadata' => 'array'];
}
