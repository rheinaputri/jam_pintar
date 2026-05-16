<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecommendationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recommendations')->insert([
            [
                'prefered_study_time'           => 'Morning',
                'recomendation'        => 'Belajar paling efektif pada pagi hari sekitar pukul 05:30–07:30',
                'study_hour_start'     => '05:30:00',
                'study_hour_end'       => '07:30:00',
                'alt_study_hour_start' => '09:00:00',
                'alt_study_hour_end'   => '11:00:00',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'prefered_study_time'           => 'Afternoon',
                'recomendation'        => 'Belajar optimal pada siang hingga sore hari sekitar pukul 13:00–15:00',
                'study_hour_start'     => '13:00:00',
                'study_hour_end'       => '15:00:00',
                'alt_study_hour_start' => '10:00:00',
                'alt_study_hour_end'   => '12:00:00',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'prefered_study_time'           => 'Evening',
                'recomendation'        => 'Belajar optimal pada malam hari sekitar pukul 20:00–22:00',
                'study_hour_start'     => '20:00:00',
                'study_hour_end'       => '22:00:00',
                'alt_study_hour_start' => '16:00:00',
                'alt_study_hour_end'   => '18:00:00',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'prefered_study_time'           => 'Night',
                'recomendation'        => 'Belajar dalam sesi pendek dengan jeda karena pola fokus tidak stabil',
                'study_hour_start'     => '07:00:00',
                'study_hour_end'       => '09:00:00',
                'alt_study_hour_start' => '19:00:00',
                'alt_study_hour_end'   => '21:00:00',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);
    }
}
 