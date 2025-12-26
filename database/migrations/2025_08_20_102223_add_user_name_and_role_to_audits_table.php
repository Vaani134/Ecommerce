<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            if (!Schema::hasColumn('audits', 'user_name')) {
                $table->string('user_name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('audits', 'user_role')) {
                $table->string('user_role')->nullable()->after('user_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->dropColumn(['user_name', 'user_role']);
        });
    }
};
 