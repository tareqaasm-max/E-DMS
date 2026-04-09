<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['code', 'name', 'description', 'status', 'starts_at', 'ends_at', 'created_by'];
}
