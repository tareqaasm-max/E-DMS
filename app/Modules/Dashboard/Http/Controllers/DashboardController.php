<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Document;
use App\Models\Project;
use App\Modules\Shared\Support\ApiResponse;

class DashboardController extends Controller
{
    public function summary()
    {
        return ApiResponse::success([
            'projects' => Project::count(),
            'pending_approvals' => Approval::where('status', 'pending')->count(),
            'documents' => Document::count(),
            'overdue' => 0,
        ]);
    }
}
