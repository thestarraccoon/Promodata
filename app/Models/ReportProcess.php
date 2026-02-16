<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportProcess extends Model
{
    use HasFactory;

    protected $table = 'report_processes';
    protected $fillable = [
        'rp_pid',
        'rp_start_datetime',
        'rp_exec_time',
        'ps_id',
        'rp_file_save_path'
    ];

    protected $casts = [
        'rp_exec_time' => 'decimal:4',
        'rp_start_datetime' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(ProcessStatus::class, 'ps_id');
    }
}
