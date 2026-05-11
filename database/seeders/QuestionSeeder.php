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
<<<<<<< Updated upstream
                'question_text' => 'Jam berapa kamu biasanya merasa paling produktif?',
                'question_type' => 'test',
                'option'        => json_encode(['A' => 'Pagi', 'B' => 'Siang', 'C' => 'Malam']),
=======
                'question_text' => 'Jika kamu diberi tugas berat secara mendadak, apa yang kamu rasakan?',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['Semangat', 'Lemas', 'Mengantuk', 'Biasa Saja']),
>>>>>>> Stashed changes
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
<<<<<<< Updated upstream
                'question_text' => 'Seberapa sering kamu merasa mengantuk saat belajar pagi?',
                'question_type' => 'rating',
                'option'        => json_encode(['1' => 'Sangat jarang', '5' => 'Sangat sering']),
=======
                'question_text' => 'Pilih gambar yang paling menggambarkan dirimu saat belajar:',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['/img/question/OptionExmpl1.png', '/img/question/OptionExmpl2.png', '/img/question/OptionExmpl3.png', '/img/question/OptionExmpl4.png']),
>>>>>>> Stashed changes
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
<<<<<<< Updated upstream
                'question_text' => 'Bagaimana pendapatmu tentang rekomendasi jam belajar ini?',
                'question_type' => 'post_test',
                'option'        => json_encode([]),
                'answer_type'   => 'essay',
=======
                'question_text' => 'Bagaimana kamu menangani stres akademik?',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['Istirahat cukup', 'Berolahraga', 'Curhat ke teman', 'Fokus pada tugas']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Pilih suasana yang paling mendukung produktivitasmu:',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['/img/question/OptionExmpl1.png', '/img/question/OptionExmpl2.png', '/img/question/OptionExmpl3.png', '/img/question/OptionExmpl4.png']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Apa tipe pelajar yang kamu miliki?',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['Visual', 'Auditori', 'Kinestik', 'Membaca/Menulis']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Pilih gaya belajar yang paling sesuai:',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['/img/question/OptionExmpl1.png', '/img/question/OptionExmpl2.png', '/img/question/OptionExmpl3.png', '/img/question/OptionExmpl4.png']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Preferensi waktu belajar terbaikmu?',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['Pagi', 'Siang', 'Malam', 'Tengah malam']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Pilih metode belajar yang paling efektif untukmu:',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['/img/question/OptionExmpl1.png', '/img/question/OptionExmpl2.png', '/img/question/OptionExmpl3.png', '/img/question/OptionExmpl4.png']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Hambatan terbesarmu dalam belajar?',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['Konsentrasi', 'Motivasi', 'Memahami materi', 'Manajemen waktu']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Pilih goals belajar yang ingin kamu capai:',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['/img/question/OptionExmpl1.png', '/img/question/OptionExmpl2.png', '/img/question/OptionExmpl3.png', '/img/question/OptionExmpl4.png']),
                'answer_type'   => 'choice',
>>>>>>> Stashed changes
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
