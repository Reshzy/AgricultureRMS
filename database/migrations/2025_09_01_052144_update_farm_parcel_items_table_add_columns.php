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
        Schema::table('farm_parcel_items', function (Blueprint $table) {
            if (!Schema::hasColumn('farm_parcel_items', 'farm_parcel_id')) {
                $table->foreignId('farm_parcel_id')->constrained()->cascadeOnDelete();
            }
            if (!Schema::hasColumn('farm_parcel_items', 'kind')) {
                $table->enum('kind', ['crop','livestock','poultry'])->after('farm_parcel_id');
            }
            if (!Schema::hasColumn('farm_parcel_items', 'name')) {
                $table->string('name')->after('kind');
            }
            if (!Schema::hasColumn('farm_parcel_items', 'size_ha')) {
                $table->decimal('size_ha',10,2)->nullable()->after('name');
            }
            if (!Schema::hasColumn('farm_parcel_items', 'num_of_head')) {
                $table->unsignedInteger('num_of_head')->nullable()->after('size_ha');
            }
            if (!Schema::hasColumn('farm_parcel_items', 'farm_type')) {
                $table->string('farm_type')->nullable()->after('num_of_head');
            }
            if (!Schema::hasColumn('farm_parcel_items', 'is_organic_practitioner')) {
                $table->boolean('is_organic_practitioner')->default(false)->after('farm_type');
            }
            if (!Schema::hasColumn('farm_parcel_items', 'remarks')) {
                $table->string('remarks')->nullable()->after('is_organic_practitioner');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farm_parcel_items', function (Blueprint $table) {
            // no-op
        });
    }
};
