<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = ['document_id', 'workflow_step_id', 'approver_id', 'status', 'comments', 'acted_at'];
}
