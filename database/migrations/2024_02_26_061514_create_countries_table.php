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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country_code');
            $table->string('description');
            $table->string('iso3')->nullable();
            $table->string('currency');
            $table->string('currency_symbol');
            $table->string('currency_symbol_html')->nullable();
            $table->string('currency_title')->nullable();
            $table->string('flagimage')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_popular');
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
