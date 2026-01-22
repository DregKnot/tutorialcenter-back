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

        Schema::create('subjects_enrollments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_enrollment');
            $table->foreign('course_enrollment')->references('id')->on('courses_enrollments');
            $table->bigInteger('subject');
            $table->foreign('subject')->references('id')->on('subjects');
            $table->bigInteger('student');
            $table->foreign('student')->references('id')->on('students');
            $table->float('progress')->default('0')->comment('measured in percentage');
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
        Schema::dropIfExists('subjects_enrollments');
    }
};
