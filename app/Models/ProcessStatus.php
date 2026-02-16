<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStatus extends Model
{
    protected $table = 'process_statuses';
    protected $fillable = ['ps_name'];
    public $timestamps = false;
}
