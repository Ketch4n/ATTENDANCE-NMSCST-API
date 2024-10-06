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
        Schema::create('dtr_location', function (Blueprint $table) {
            $table->id();
            $table->integer('dtr_id');
            $table->string('in_am_latitude');
            $table->string('in_am_longitude');
            $table->string('out_am_latitude');
            $table->string('out_am_longitude');
            $table->string('in_pm_latitude');
            $table->string('in_pm_longitude');
            $table->string('out_pm_latitude');
            $table->string('out_pm_longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtr_location');
    }
};
