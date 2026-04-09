<?php

namespace App\Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Document;
use App\Models\Project;
use App\Modules\Shared\Support\ApiResponse;

class ReportController extends Controller
{
    public function documentStatus()
    {
        return ApiResponse::success([
            'draft' => Document::where('status', 'draft')->count(),
            'under_review' => Document::where('status', 'under_review')->count(),
            'approved' => Document::where('status', 'approved')->count(),
            'rejected' => Document::where('status', 'rejected')->count(),
        ]);
    }

    public function approvalDelays()
    {
        return ApiResponse::success([
            'pending_total' => Approval::where('status', 'pending')->count(),
            'delayed_over_3_days' => 0,
        ]);
    }

    public function projectProgress()
    {
        return ApiResponse::success([
            'planned' => Project::where('status', 'planned')->count(),
            'active' => Project::where('status', 'active')->count(),
            'on_hold' => Project::where('status', 'on_hold')->count(),
            'completed' => Project::where('status', 'completed')->count(),
        ]);
    }
}
