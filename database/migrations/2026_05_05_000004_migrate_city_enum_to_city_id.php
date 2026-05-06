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
        // Ensure `city_id` column exists
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'city_id')) {
                $table->unsignedBigInteger('city_id')->nullable()->after('city');
                $table->foreign('city_id')->references('id')->on('cities')->nullOnDelete();
            }
        });

        // Mapping rules from enum values to explicit city names (use exact match to avoid ambiguous mapping)
        $map = [
            'jakarta' => 'jakarta pusat',
            'surabaya' => 'surabaya',
            'malang' => 'malang',
            'jogja' => 'yogyakarta',
        ];

        foreach ($map as $enumValue => $searchTerm) {
            // Find a city record that matches the search term exactly (case-insensitive)
            $city = DB::table('cities')
                ->whereRaw('LOWER(name) = ?', [strtolower($searchTerm)])
                ->orderBy('id')
                ->first();

            if ($city) {
                // Only update users that still have a null city_id (avoid overwriting previously set values)
                DB::table('users')
                    ->whereNull('city_id')
                    ->where('city', $enumValue)
                    ->update(['city_id' => $city->id]);
            }
        }

        // Drop the enum `city` column after mapping
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'city')) {
                $table->dropColumn('city');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate the `city` enum column (no automatic reverse mapping)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'city')) {
                $table->enum('city', ['jakarta', 'surabaya', 'malang', 'jogja'])->nullable()->after('profile_img');
            }
        });

        // Note: We intentionally do not attempt to map `city_id` back to the enum values automatically.
    }
};
