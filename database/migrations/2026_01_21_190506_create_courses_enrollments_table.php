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
        Schema::disableForeignKeyConstraints();

        Schema::create('courses_enrollments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course');
            $table->foreign('course')->references('id')->on('courses');
            $table->bigInteger('student');
            $table->foreign('student')->references('id')->on('students');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('billing_cycle', ["monthly","quarterly","semi-annual","annual"]);
            $table->decimal('cost');
            $table->softDeletes()->comment('Use Laravel softDelete module');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_enrollments');
    }
};
