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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->integer('employee_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->integer('phone');
            $table->decimal('salary');
            $table->string('gender')->default('male');
            $table->string('image')->nullable();
            $table->tinyInteger('accept')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
