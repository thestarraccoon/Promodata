<?php
namespace App\Models;

use App\Enums\ProcessStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ReportProcess extends Model
{
    protected $table = 'report_process';
    protected $primaryKey = 'rp_id';
    public $incrementing = true;

    protected $fillable = [
        'rp_pid', 'rp_start_datetime', 'rp_exec_time', 'ps_id', 'rp_file_save_path'
    ];

    protected $casts = [
        'rp_start_datetime' => 'datetime',
        'rp_exec_time' => 'decimal:4',
    ];

    public function status()
    {
        return $this->belongsTo(ProcessStatus::class, 'ps_id', 'ps_id');
    }

    public function getDownloadUrlAttribute(): ?string
    {
        if (!$this->rp_file_save_path || !$this->isCompleted()) {
            return null;
        }
        return Storage::disk('public')->url($this->rp_file_save_path);
    }

    public function isCompleted(): bool
    {
        return $this->status->ps_name === ProcessStatuses::COMPLETED;
    }
}
