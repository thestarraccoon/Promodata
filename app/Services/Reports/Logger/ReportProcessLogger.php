<?php

namespace App\Services\Reports\Logger;

use App\Enums\ProcessStatuses;
use App\Models\ProcessStatus;
use App\Models\ReportProcess;
use Illuminate\Support\Facades\Log;

class ReportProcessLogger
{
    private ReportProcess $process;

    public function start()
    {
        $this->process = ReportProcess::create([
            'rp_pid' => getmypid() ?: 0,
            'rp_start_datetime' => now(),
            'ps_id' => ProcessStatus::where('ps_name', ProcessStatuses::RUNNING)->first()->ps_id,
            'rp_exec_time' => 0,
        ]);

        Log::info('Отчёт запущен', ['rp_id' => $this->process->rp_id]);
    }

    public function success(string $filePath)
    {
        $time = now()->diffInSeconds($this->process->rp_start_datetime);

        $this->process->update([
            'ps_id' => ProcessStatus::where('ps_name', ProcessStatuses::COMPLETED)->first()->ps_id,
            'rp_exec_time' => $time,
            'rp_file_save_path' => $filePath,
        ]);

        Log::info('Отчёт завершён успешно', [
            'rp_id' => $this->process->rp_id,
            'file' => $filePath,
            'time_sec' => $time
        ]);
    }

    public function error(string $message)
    {
        $time = now()->diffInSeconds($this->process->rp_start_datetime);

        $this->process->update([
            'ps_id' => ProcessStatus::where('ps_name', ProcessStatuses::FAILED)->first()->ps_id,
            'rp_exec_time' => $time,
            'rp_file_save_path' => null,
        ]);

        Log::error('Ошибка отчёта', [
            'rp_id' => $this->process->rp_id,
            'error' => $message,
            'time_sec' => $time
        ]);
    }
}
