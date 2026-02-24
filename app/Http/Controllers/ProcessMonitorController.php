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
            ->paginate(10);

        return view('processes.monitor', compact('processes'));
    }
}
