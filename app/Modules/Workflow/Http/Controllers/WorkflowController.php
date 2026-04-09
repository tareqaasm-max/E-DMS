<?php

namespace App\Modules\Workflow\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Shared\Support\ApiResponse;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function index()
    {
        return ApiResponse::success(['items' => []], 'Implement workflow repository');
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => 'required|string|max:191',
            'project_id' => 'nullable|integer',
        ]);
        return ApiResponse::success(['workflow' => $payload], 'Created', 201);
    }

    public function show(int $id)
    {
        return ApiResponse::success(['workflow_id' => $id]);
    }

    public function storeSteps(Request $request, int $id)
    {
        $data = $request->validate([
            'steps' => 'required|array|min:1',
            'steps.*.step_order' => 'required|integer|min:1',
            'steps.*.role_name' => 'required|string|max:100',
        ]);
        return ApiResponse::success(['workflow_id' => $id, 'steps' => $data['steps']], 'Steps saved');
    }
}
