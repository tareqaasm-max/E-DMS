<?php

namespace App\Modules\Workflow\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Modules\Shared\Support\ApiResponse;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function approve(int $id)
    {
        $approval = Approval::findOrFail($id);
        $approval->update(['status' => 'approved', 'acted_at' => now()]);
        return ApiResponse::success(['approval' => $approval], 'Approved');
    }

    public function reject(Request $request, int $id)
    {
        $approval = Approval::findOrFail($id);
        $approval->update([
            'status' => 'rejected',
            'comments' => $request->input('comments'),
            'acted_at' => now(),
        ]);
        return ApiResponse::success(['approval' => $approval], 'Rejected');
    }

    public function comment(Request $request, int $id)
    {
        $approval = Approval::findOrFail($id);
        $approval->update(['comments' => $request->input('comments')]);
        return ApiResponse::success(['approval' => $approval], 'Comment saved');
    }
}
