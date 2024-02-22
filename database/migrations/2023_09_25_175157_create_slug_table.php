<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slugs', function (Blueprint $table) {
            $table->id();
            $table->morphs('entity');
            $table->string('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slugs');
    }
};