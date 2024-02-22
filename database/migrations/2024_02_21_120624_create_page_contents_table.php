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
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('section');
            $table->string('sub_section');
            $table->string('heading');
            $table->text('content');
            $table->string('page_tag_line');
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_alt')->nullable();
            $table->string('heading_content1');
            $table->string('heading_subcontent1');
            $table->string('heading_content2');
            $table->string('heading_subcontent2');
            $table->string('heading_content3');
            $table->string('heading_subcontent3');
            $table->string('heading_content4');
            $table->string('heading_subcontent4');
            $table->integer('created_by');
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
