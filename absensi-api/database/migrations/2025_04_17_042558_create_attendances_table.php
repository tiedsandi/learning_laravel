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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('office_id');
            $table->string('lat_from_employee');
            $table->string('long_from_employee');
            $table->string('lat_from_office');
            $table->string('long_from_office');
            $table->dateTimeTz('attendance_in');
            $table->dateTimeTz('attendance_out');
            $table->tinyInteger('status');
            $table->text('description');
            $table->foreign('employee_id')->on('employees')->references('id')->onDelete('cascade');
            $table->foreign('office_id')->on('offices')->references('id')->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
