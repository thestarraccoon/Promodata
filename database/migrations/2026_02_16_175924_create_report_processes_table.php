<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('report_processes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rp_pid')->nullable(false);
            $table->timestamp('rp_start_datetime');
            $table->decimal('rp_exec_time', 10, 4)->nullable();
            $table->unsignedTinyInteger('ps_id');
            $table->text('rp_file_save_path')->nullable();
            $table->timestamps();

            $table->foreign('ps_id')->references('id')->on('process_statuses');
            $table->index(['rp_pid', 'rp_start_datetime']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_processes');
    }
};
