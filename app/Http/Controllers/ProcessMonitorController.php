<?php

namespace App\Http\Controllers;

use App\Models\ReportProcess;
use Illuminate\Http\Request;

class ProcessMonitorController extends Controller
{
    public function index()
    {
        $processes = ReportProcess::with('status')
            ->orderBy('rp_start_datetime', 'desc')
            ->paginate(20);

        $stats = [
            'completed' => ReportProcess::whereHas('status', fn($q) => $q->where('ps_name', 'completed'))->count(),
            'failed' => ReportProcess::whereHas('status', fn($q) => $q->where('ps_name', 'failed'))->count(),
            'running' => ReportProcess::whereHas('status', fn($q) => $q->where('ps_name', 'running'))->count(),
            'total' => ReportProcess::count(),
        ];

        return view('processes.monitor', compact('processes', 'stats'));
    }
}
