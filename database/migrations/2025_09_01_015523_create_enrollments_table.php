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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            // Photo
            $table->string('photo_path')->nullable();

            // Personal Information
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('extension_name')->nullable();
            $table->enum('sex', ['male','female']);

            // Address
            $table->string('address_house_lot')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_barangay')->nullable();
            $table->string('address_municipality_city')->nullable();
            $table->string('address_province')->nullable();
            $table->string('address_region')->nullable();

            // Contact
            $table->string('mobile_number')->nullable();
            $table->string('landline_number')->nullable();

            // Birth
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();

            // Education, religion, civil status
            $table->string('highest_formal_education')->nullable();
            $table->string('religion')->nullable();
            $table->enum('civil_status', ['single','married','widowed','separated'])->nullable();
            $table->string('name_of_spouse')->nullable();
            $table->string('mothers_maiden_name')->nullable();

            // Household
            $table->boolean('household_head')->default(false);
            $table->string('household_head_name')->nullable();
            $table->string('relationship_to_head')->nullable();
            $table->unsignedInteger('household_members_total')->default(0);
            $table->unsignedInteger('household_members_male')->default(0);
            $table->unsignedInteger('household_members_female')->default(0);

            // Special statuses
            $table->boolean('is_pwd')->default(false);
            $table->boolean('is_four_ps_beneficiary')->default(false);
            $table->boolean('is_indigenous_group_member')->default(false);
            $table->string('indigenous_group_specify')->nullable();
            $table->boolean('has_government_id')->default(false);
            $table->string('government_id_type')->nullable();
            $table->string('government_id_number')->nullable();

            // Emergency contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();

            // Livelihood
            $table->enum('main_livelihood', ['farmer','farmworker','fisherfolk','agri_youth']);

            // Farmer specifics
            $table->json('farming_activities')->nullable(); // e.g. ["rice","corn","other_crops","livestock","poultry"]
            $table->string('other_crop_specify')->nullable();
            $table->string('livestock_type_specify')->nullable();
            $table->string('poultry_type_specify')->nullable();

            // Farmworker specifics
            $table->json('farmworker_kinds_of_work')->nullable();
            $table->string('farmworker_other_work')->nullable();

            // Fisherfolk specifics
            $table->json('fishing_activities')->nullable();
            $table->string('fishing_other_activity')->nullable();

            // Agri youth specifics
            $table->json('agriyouth_involvements')->nullable();
            $table->string('agriyouth_other_involvement')->nullable();

            // Income
            $table->decimal('gross_income_farming', 12, 2)->nullable();
            $table->decimal('gross_income_non_farming', 12, 2)->nullable();

            // Rotation farmers
            $table->string('rotation_farmers_p1')->nullable();
            $table->string('rotation_farmers_p2')->nullable();
            $table->string('rotation_farmers_p3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
