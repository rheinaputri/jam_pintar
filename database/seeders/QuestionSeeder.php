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
                'question_text' => 'Jika kamu diberi tugas berat secara mendadak, apa yang kamu rasakan?',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['Semangat', 'Lemas', 'Mengantuk', 'Biasa Saja']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Pilih gambar yang paling menggambarkan dirimu saat belajar:',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['/img/question/OptionExmpl1.png', '/img/question/OptionExmpl2.png', '/img/question/OptionExmpl3.png', '/img/question/OptionExmpl4.png']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'question_text' => 'Bagaimana kamu menangani stres akademik?',
                'question_type' => 'kuisioner',
                'option'        => json_encode(['Istirahat cukup', 'Berolahraga', 'Curhat ke teman', 'Fokus pada tugas']),
                'answer_type'   => 'choice',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
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
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
