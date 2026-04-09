<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $stats = [
        'projects' => DB::table('projects')->count(),
        'pending_approvals' => DB::table('approvals')->where('status', 'pending')->count(),
        'documents' => DB::table('documents')->count(),
        'overdue' => 0,
    ];
    return view('dashboard', compact('stats'));
});
