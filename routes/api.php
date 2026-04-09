<?php

use App\Modules\Auth\Http\Controllers\AuthController;
use App\Modules\Dashboard\Http\Controllers\DashboardController;
use App\Modules\Documents\Http\Controllers\DocumentController;
use App\Modules\Projects\Http\Controllers\ProjectController;
use App\Modules\Reports\Http\Controllers\ReportController;
use App\Modules\Transmittals\Http\Controllers\TransmittalController;
use App\Modules\Workflow\Http\Controllers\ApprovalController;
use App\Modules\Workflow\Http\Controllers\WorkflowController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('documents', DocumentController::class)->except(['store']);
        Route::post('documents/upload', [DocumentController::class, 'upload']);
        Route::post('documents/{id}/versions', [DocumentController::class, 'newVersion']);
        Route::get('documents/{id}/download', [DocumentController::class, 'download']);
        Route::apiResource('workflows', WorkflowController::class)->only(['index', 'store', 'show']);
        Route::post('workflows/{id}/steps', [WorkflowController::class, 'storeSteps']);
        Route::post('approvals/{id}/approve', [ApprovalController::class, 'approve']);
        Route::post('approvals/{id}/reject', [ApprovalController::class, 'reject']);
        Route::post('approvals/{id}/comment', [ApprovalController::class, 'comment']);
        Route::apiResource('transmittals', TransmittalController::class);
        Route::post('transmittals/{id}/documents', [TransmittalController::class, 'attachDocuments']);
        Route::get('dashboard/summary', [DashboardController::class, 'summary']);
        Route::get('reports/document-status', [ReportController::class, 'documentStatus']);
        Route::get('reports/approval-delays', [ReportController::class, 'approvalDelays']);
        Route::get('reports/project-progress', [ReportController::class, 'projectProgress']);
    });
});
