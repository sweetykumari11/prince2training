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
        Schema::table('users', function (Blueprint $table) {
            $table->string('reset_token')->nullable()->after('is_active');
            $table->timestamp('last_login_at')->nullable()->after('reset_token');
            $table->timestamp('password_changed_at')->nullable()->after('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reset_token');
            $table->dropColumn('last_login_at');
            $table->dropColumn('password_changed_at');
        });
    }
};
