<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestAttemptSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('test_attempts')->insert([
            [
                'user_id'     => 1,
                'started_at'  => '2026-03-02 20:00:00',
                'finished_at' => '2026-03-02 20:10:00',
            ],
            [
                'user_id'     => 1,
                'started_at'  => '2026-03-05 21:00:00',
                'finished_at' => '2026-03-05 21:08:00',
            ],
        ]);
 
        DB::table('answers')->insert([
            [
                'question_id'     => 1,
                'test_attempt_id' => 1,
                'answer'          => 'Malam',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'question_id'     => 2,
                'test_attempt_id' => 1,
                'answer'          => '4',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'question_id'     => 1,
                'test_attempt_id' => 2,
                'answer'          => 'Pagi',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'question_id'     => 2,
                'test_attempt_id' => 2,
                'answer'          => '2',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
 
        DB::table('results')->insert([
            [
                'test_attempt_id'   => 1,
                'recommendation_id' => 3, // wolf
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'test_attempt_id'   => 2,
                'recommendation_id' => 1, // lion
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
