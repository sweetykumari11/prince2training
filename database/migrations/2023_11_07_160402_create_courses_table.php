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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('topic_id');
            $table->string('logo')->nullable();
            $table->Integer('parentCourseId')->nullable();
            $table->string('url')->nullable();
            $table->string('coursecode')->nullable();
            $table->tinyInteger('is_weekend')->nullable();
            $table->tinyInteger('is_module')->nullable();
            $table->tinyInteger('is_technical')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
