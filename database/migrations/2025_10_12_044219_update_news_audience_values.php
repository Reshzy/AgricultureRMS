<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update existing data to use new values
        DB::table('news')->where('audience', 'all')->update(['audience' => 'all_farmers']);
        DB::table('news')->where('audience', 'dairy')->update(['audience' => 'farmers']);
        DB::table('news')->where('audience', 'crop')->update(['audience' => 'farmers']);
        DB::table('news')->where('audience', 'poultry')->update(['audience' => 'farmers']);
        DB::table('news')->where('audience', 'organic')->update(['audience' => 'farmers']);

        // Then modify the column to accept the new values
        Schema::table('news', function (Blueprint $table) {
            $table->string('audience')->default('all_farmers')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert data back to old values
        DB::table('news')->where('audience', 'all_farmers')->update(['audience' => 'all']);
        DB::table('news')->whereIn('audience', ['farmers', 'farmworker_laborer', 'fisherfolk', 'agri_youth'])->update(['audience' => 'all']);

        // Revert the column back to enum
        Schema::table('news', function (Blueprint $table) {
            $table->enum('audience', ['all', 'dairy', 'crop', 'poultry', 'organic'])->default('all')->change();
        });
    }
};
