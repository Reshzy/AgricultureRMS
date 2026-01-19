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
        Schema::create('farm_parcel_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_parcel_id')->constrained()->cascadeOnDelete();
            $table->enum('kind', ['crop','livestock','poultry']);
            $table->string('name');
            $table->decimal('size_ha', 10, 2)->nullable();
            $table->unsignedInteger('num_of_head')->nullable();
            $table->string('farm_type')->nullable();
            $table->boolean('is_organic_practitioner')->default(false);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_parcel_items');
    }
};
