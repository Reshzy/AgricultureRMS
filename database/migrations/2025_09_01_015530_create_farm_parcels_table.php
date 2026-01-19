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
        Schema::create('farm_parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();

            // Location and area
            $table->string('barangay')->nullable();
            $table->string('municipality')->nullable();
            $table->decimal('total_farm_area_ha', 10, 2)->nullable();

            // Ownership and statuses
            $table->string('ownership_document_no')->nullable();
            $table->boolean('within_ancestral_domain')->default(false);
            $table->boolean('is_agrarian_reform_beneficiary')->default(false);
            $table->enum('ownership_type', ['registered_owner','tenant','lessee','others'])->nullable();
            $table->string('land_owner_name')->nullable();
            $table->string('ownership_other_specify')->nullable();

            // Commodity and sizes
            $table->string('crop_commodity')->nullable(); // Rice/Corn/HVC/Livestock/Poultry/Agri-fishery
            $table->string('livestock_poultry_type')->nullable();
            $table->decimal('size_ha', 10, 2)->nullable();
            $table->unsignedInteger('num_of_head')->nullable();

            $table->string('farm_type')->nullable();
            $table->boolean('is_organic_practitioner')->default(false);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_parcels');
    }
};
