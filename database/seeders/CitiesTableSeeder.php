<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Imports Indonesian cities from ibnux/data-indonesia GitHub repository
     */
    public function run(): void
    {
        $this->command->info('Importing Indonesian cities from GitHub...');
        
        // Call the import command
        Artisan::call('import:cities');
        
        $this->command->info('Cities imported successfully!');
    }
}
