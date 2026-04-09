<?php

namespace App\Modules\Documents\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Modules\Shared\Support\ApiResponse;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::query();
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->integer('project_id'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        return ApiResponse::success(['items' => $query->latest()->paginate(20)->items()]);
    }

    public function upload(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|string|max:500',
            'file_type' => 'required|string|max:20',
            'file_size' => 'required|integer|min:1',
        ]);

        $data['document_no'] = 'DOC-' . now()->format('YmdHis');
        $data['uploaded_by'] = $request->user()->id;
        $data['current_version'] = 1;
        $document = Document::create($data);

        return ApiResponse::success(['document' => $document], 'Uploaded', 201);
    }

    public function show(int $id)
    {
        return ApiResponse::success(['document' => Document::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $doc = Document::findOrFail($id);
        $doc->update($request->only(['title', 'metadata', 'status', 'folder_id']));
        return ApiResponse::success(['document' => $doc], 'Updated');
    }

    public function newVersion(int $id)
    {
        $doc = Document::findOrFail($id);
        $doc->increment('current_version');
        return ApiResponse::success(['document' => $doc], 'Version incremented');
    }

    public function download(int $id)
    {
        $doc = Document::findOrFail($id);
        return ApiResponse::success(['path' => $doc->file_path], 'Use signed-url implementation in production');
    }

    public function destroy(int $id)
    {
        Document::findOrFail($id)->delete();
        return ApiResponse::success([], 'Deleted');
    }
}
