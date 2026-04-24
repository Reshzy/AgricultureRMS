<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $defaults = [
            'Weather',
            'Market',
            'Training',
            'Government',
            'Technology',
        ];

        foreach ($defaults as $index => $name) {
            DB::table('news_categories')->updateOrInsert(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('news_categories')
            ->whereIn('slug', ['weather', 'market', 'training', 'government', 'technology'])
            ->delete();
    }
};
