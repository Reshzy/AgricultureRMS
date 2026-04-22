<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_main_admin')->default(false)->after('is_admin');
            $table->string('admin_request_status', 20)->default('pending')->after('is_main_admin');
            $table->timestamp('approved_at')->nullable()->after('admin_request_status');
            $table->index('admin_request_status');
        });

        DB::table('users')
            ->where('is_admin', true)
            ->update([
                'admin_request_status' => 'approved',
                'approved_at' => now(),
            ]);

        $firstAdminId = DB::table('users')
            ->where('is_admin', true)
            ->orderBy('id')
            ->value('id');

        if ($firstAdminId !== null) {
            DB::table('users')
                ->where('id', $firstAdminId)
                ->update(['is_main_admin' => true]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['admin_request_status']);
            $table->dropColumn(['is_main_admin', 'admin_request_status', 'approved_at']);
        });
    }
};
