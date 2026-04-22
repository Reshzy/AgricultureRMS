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
        if (! Schema::hasTable('claims') || ! Schema::hasTable('claim_documents')) {
            return;
        }

        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        $databaseName = (string) config('database.connections.mysql.database');

        $hasForeignKey = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', $databaseName)
            ->where('TABLE_NAME', 'claim_documents')
            ->where('COLUMN_NAME', 'claim_id')
            ->where('REFERENCED_TABLE_NAME', 'claims')
            ->exists();

        if ($hasForeignKey) {
            return;
        }

        $hasIndex = DB::table('information_schema.STATISTICS')
            ->where('TABLE_SCHEMA', $databaseName)
            ->where('TABLE_NAME', 'claim_documents')
            ->where('INDEX_NAME', 'claim_documents_claim_id_index')
            ->exists();

        Schema::table('claim_documents', function (Blueprint $table) use ($hasIndex): void {
            if (! $hasIndex) {
                $table->index('claim_id');
            }

            $table->foreign('claim_id')->references('id')->on('claims')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('claim_documents')) {
            return;
        }

        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        $databaseName = (string) config('database.connections.mysql.database');
        $hasForeignKey = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', $databaseName)
            ->where('TABLE_NAME', 'claim_documents')
            ->where('COLUMN_NAME', 'claim_id')
            ->where('REFERENCED_TABLE_NAME', 'claims')
            ->exists();

        if (! $hasForeignKey) {
            return;
        }

        Schema::table('claim_documents', function (Blueprint $table): void {
            $table->dropForeign(['claim_id']);
        });
    }
};
