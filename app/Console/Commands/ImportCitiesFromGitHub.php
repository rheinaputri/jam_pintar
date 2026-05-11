<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ImportCitiesFromGitHub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Indonesian cities from ibnux/data-indonesia GitHub repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting import of Indonesian cities...');
        
        try {
            // Disable foreign key checks temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            // Clear existing cities
            DB::table('cities')->truncate();
            
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            // Base URL untuk data
            $baseUrl = 'https://raw.githubusercontent.com/ibnux/data-indonesia/master';
            
            // Get provinces
            $this->info('Fetching provinces...');
            $provinsiResponse = Http::timeout(30)->get("{$baseUrl}/provinsi.json");
            
            if (!$provinsiResponse->successful()) {
                $this->error('Failed to fetch provinces');
                return 1;
            }
            
            $provinces = $provinsiResponse->json();
            $totalCities = 0;
            
            // Loop setiap provinsi
            foreach ($provinces as $province) {
                $provinceId = $province['id'];
                $provinceName = $province['nama'];
                
                $this->line("Processing: {$provinceName}");
                
                // Get kabupaten/kota untuk provinsi ini
                $regenciesResponse = Http::timeout(30)->get("{$baseUrl}/kabupaten/{$provinceId}.json");
                
                if (!$regenciesResponse->successful()) {
                    $this->warn("Failed to fetch cities for {$provinceName}");
                    continue;
                }
                
                $regencies = $regenciesResponse->json();
                
                // Insert cities
                foreach ($regencies as $regency) {
                    City::create([
                        'regency_code' => $regency['id'],
                        'name' => $regency['nama'],
                        'type' => $regency['tipe'] ?? 'Kabupaten',
                        'province' => $provinceName,
                        'lat' => null,
                        'lon' => null,
                    ]);
                    $totalCities++;
                }
                
                $this->line("✓ Imported " . count($regencies) . " cities");
            }
            
            $this->info("✓ Successfully imported {$totalCities} cities!");
            return 0;
            
        } catch (\Exception $e) {
            $this->error("Import failed: " . $e->getMessage());
            return 1;
        }
    }
}
