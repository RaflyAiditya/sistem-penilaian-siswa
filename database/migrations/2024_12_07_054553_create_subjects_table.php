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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name');
            $table->string('class');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->enum('day', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->time('time', precision: 0);
            $table->integer('duration');
            $table->timestamps();

            $table->time('time_start', precision: 0)->after('time');
            $table->time('time_end', precision: 0)->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};