<?php

namespace App\Modules\Projects\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Modules\Shared\Support\ApiResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return ApiResponse::success(['items' => Project::latest()->paginate(20)->items()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:64|unique:projects,code',
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
        ]);
        $data['created_by'] = $request->user()->id;
        $project = Project::create($data);
        return ApiResponse::success(['project' => $project], 'Created', 201);
    }

    public function show(int $id)
    {
        return ApiResponse::success(['project' => Project::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->only(['name', 'description', 'status', 'starts_at', 'ends_at']));
        return ApiResponse::success(['project' => $project], 'Updated');
    }

    public function destroy(int $id)
    {
        Project::findOrFail($id)->delete();
        return ApiResponse::success([], 'Deleted');
    }
}
