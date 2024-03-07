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
        Schema::create('coursedetails', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('country_id');
            $table->text('heading');
            $table->text('summary');
            $table->text('detail');
            $table->text('overview');
            $table->text('whats_included');
            $table->text('pre_requisite');
            $table->text('who_should_attend');
            $table->integer('added_by')->nullable();
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            $table->Integer('duration')->nullable();
            $table->Integer('pdu')->nullable();
            $table->text('audience')->nullable();
            $table->Integer('accreditationId')->nullable();
            $table->text('exam_included')->nullable();
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
        Schema::dropIfExists('coursedetails');
    }
};
