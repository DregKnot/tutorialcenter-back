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

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('banner');
            $table->json('courses')->comment('It can belong to multiple courses');
            $table->foreign('courses')->references('id')->on('courses');
            $table->json('departments')->comment('It can belong to many departments');
            $table->enum('status', ["active","inactive"]);
            $table->json('assignees');
            $table->foreign('assignees')->references('id')->on('staffs');
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
        Schema::dropIfExists('subjects');
    }
};
