<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_process', function (Blueprint $table) {
            $table->id('rp_id');
            $table->unsignedBigInteger('rp_pid');
            $table->timestamp('rp_start_datetime');
            $table->decimal('rp_exec_time', 10, 4)->default(0);
            $table->unsignedBigInteger('ps_id');
            $table->text('rp_file_save_path')->nullable();
            $table->timestamps();

            $table->foreign('ps_id')->references('ps_id')->on('process_status')->onDelete('cascade');

            $table->index(['rp_pid', 'rp_start_datetime']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_process');
    }
};
