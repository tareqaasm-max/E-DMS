<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transmittal extends Model
{
    protected $fillable = [
        'transmittal_no', 'project_id', 'direction', 'subject', 'status', 'sent_by', 'sent_to'
    ];
}
