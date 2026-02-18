<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        // Schema::create('class_sessions', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('class');
        //     $table->foreign('class')->references('id')->on('classes');
        //     $table->bigInteger('class_schedule');
        //     $table->foreign('class_schedule')->references('id')->on('class_schedules');
        //     $table->date('session_date');
        //     $table->time('starts_at')->nullable();
        //     $table->time('ends_at')->nullable();
        //     $table->string('class_link')->nullable()->comment('This will be the link for the class before the session starts but will change when the class end and it was recorded.');
        //     $table->enum('status', ["scheduled","completed","cancelled","recorded"]);
        //     $table->softDeletes()->comment('Use Laravel softDelete module');
        //     $table->timestamps();
        // });


        Schema::create('class_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            $table->foreignId('class_schedule_id')
                ->constrained('class_schedules')
                ->cascadeOnDelete();

            $table->date('session_date')->index();

            $table->time('starts_at')->nullable();
            $table->time('ends_at')->nullable();

            $table->string('class_link')->nullable();
            $table->string('recording_link')->nullable();

            $table->enum('status', [
                'scheduled',
                'completed',
                'cancelled',
                'recorded'
            ])->default('scheduled')
                ->index();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_sessions');
    }
};
