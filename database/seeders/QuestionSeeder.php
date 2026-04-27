<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'question_text' => 'Jam berapa kamu biasanya merasa paling produktif?',
                'question_type' => 'test',
                'option'        => json_encode(['A' => 'Pagi', 'B' => 'Siang', 'C' => 'Malam']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Seberapa sering kamu merasa mengantuk saat belajar pagi?',
                'question_type' => 'rating',
                'option'        => json_encode(['1' => 'Sangat jarang', '5' => 'Sangat sering']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Bagaimana pendapatmu tentang rekomendasi jam belajar ini?',
                'question_type' => 'post_test',
                'option'        => json_encode([]),
                'answer_type'   => 'essay',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
