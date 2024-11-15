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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('status', ['positive', 'recovered', 'dead']);
            $table->date('in_date_at');
            $table->date('out_date_at');
            $table->unsignedBigInteger('patients_infos_id');
            $table->foreign('patients_infos_id')->references('id')->on('patients_infos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
