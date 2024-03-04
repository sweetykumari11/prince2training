<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations..
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->Integer('tka_id')->nullable();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_popular')->default(1);
            $table->tinyInteger('is_technical')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        //
    }
};
