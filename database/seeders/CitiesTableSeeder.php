<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = resource_path('data/indonesia_cities_sample.json');
        if (!file_exists($path)) {
            $this->command->info('cities JSON not found at ' . $path);
            return;
        }

        $json = file_get_contents($path);
        $items = json_decode($json, true);
        if (!is_array($items)) return;

        // Clear existing cities to avoid duplicates when re-seeding
        City::truncate();

        $chunks = array_chunk($items, 200);
        foreach ($chunks as $chunk) {
            $insert = [];
            foreach ($chunk as $it) {
                $insert[] = [
                    'regency_code' => $it['regency_code'] ?? null,
                    'name' => $it['name'] ?? null,
                    'type' => $it['type'] ?? null,
                    'province' => $it['province'] ?? null,
                    'lat' => $it['lat'] ?? null,
                    'lon' => $it['lon'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            if ($insert) City::insert($insert);
        }

        $this->command->info('Seeded ' . City::count() . ' cities');
    }
}
