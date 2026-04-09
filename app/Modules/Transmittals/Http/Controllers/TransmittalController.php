<?php

namespace App\Modules\Transmittals\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transmittal;
use App\Modules\Shared\Support\ApiResponse;
use Illuminate\Http\Request;

class TransmittalController extends Controller
{
    public function index()
    {
        return ApiResponse::success(['items' => Transmittal::latest()->paginate(20)->items()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|integer',
            'direction' => 'required|in:incoming,outgoing',
            'subject' => 'required|string|max:255',
            'sent_to' => 'nullable|string|max:255',
        ]);
        $data['transmittal_no'] = 'TRM-' . now()->format('YmdHis');
        $data['sent_by'] = $request->user()->id;
        $item = Transmittal::create($data);
        return ApiResponse::success(['transmittal' => $item], 'Created', 201);
    }

    public function show(int $id)
    {
        return ApiResponse::success(['transmittal' => Transmittal::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $item = Transmittal::findOrFail($id);
        $item->update($request->only(['subject', 'status', 'sent_to']));
        return ApiResponse::success(['transmittal' => $item], 'Updated');
    }

    public function destroy(int $id)
    {
        Transmittal::findOrFail($id)->delete();
        return ApiResponse::success([], 'Deleted');
    }

    public function attachDocuments(Request $request, int $id)
    {
        $data = $request->validate(['document_ids' => 'required|array|min:1']);
        return ApiResponse::success(['transmittal_id' => $id, 'document_ids' => $data['document_ids']], 'Attached');
    }
}
