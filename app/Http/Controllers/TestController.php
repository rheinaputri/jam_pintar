<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index(): View
    {
        // Get all test questions (adjust the query based on your setup)
        $questions = Question::where('question_type', 'test')
            ->limit(10)
            ->get();

        // If no questions in DB, use demo data
        if ($questions->isEmpty()) {
            $questions = $this->getDemoQuestions();
        }

        return view('pages.test', [
            'questions' => $questions,
            'totalQuestions' => count($questions),
        ]);
    }

    /**
     * Demo questions for testing UI
     */
    private function getDemoQuestions()
    {
        return collect([
            (object) [
                'id' => 1,
                'question_text' => 'Jika kamu diberi tugas berat secara mendadak, apa yang kamu rasakan?',
                'question_type' => 'test',
                'answer_type' => 'choice',
                'option' => ['Semangat', 'Lamas', 'Mengantuk', 'Biasa Saja'],
            ],
            (object) [
                'id' => 2,
                'question_text' => 'Pilih gambar yang paling menggambarkan dirimu saat belajar:',
                'question_type' => 'test',
                'answer_type' => 'image',
                'option' => [
                    'https://images.unsplash.com/photo-1516321318423-f06f70fc504e?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1516542848519-e21cc028cb29?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=300&fit=crop',
                ],
            ],
            (object) [
                'id' => 3,
                'question_text' => 'Bagaimana kamu menangani stres akademik?',
                'question_type' => 'test',
                'answer_type' => 'choice',
                'option' => ['Istirahat cukup', 'Berolahraga', 'Curhat ke teman', 'Fokus pada tugas'],
            ],
            (object) [
                'id' => 4,
                'question_text' => 'Pilih suasana yang paling mendukung produktivitasmu:',
                'question_type' => 'test',
                'answer_type' => 'image',
                'option' => [
                    'https://images.unsplash.com/photo-1453614512568-c4024d13c247?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1522202176988-8307cedeb628?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=300&fit=crop',
                ],
            ],
            (object) [
                'id' => 5,
                'question_text' => 'Apa tipe pelajar yang kamu miliki?',
                'question_type' => 'test',
                'answer_type' => 'choice',
                'option' => ['Visual', 'Auditori', 'Kinestik', 'Membaca/Menulis'],
            ],
            (object) [
                'id' => 6,
                'question_text' => 'Pilih gaya belajar yang paling sesuai:',
                'question_type' => 'test',
                'answer_type' => 'image',
                'option' => [
                    'https://images.unsplash.com/photo-1553531088-f352aeb5f410?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1516321318423-f06f70fc504e?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1527239884a7-25c99e4573d5?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=300&fit=crop',
                ],
            ],
            (object) [
                'id' => 7,
                'question_text' => 'Preferensi waktu belajar terbaik mu?',
                'question_type' => 'test',
                'answer_type' => 'choice',
                'option' => ['Pagi', 'Siang', 'Malam', 'Tengah malam'],
            ],
            (object) [
                'id' => 8,
                'question_text' => 'Pilih metode belajar yang paling efektif untuk mu:',
                'question_type' => 'test',
                'answer_type' => 'image',
                'option' => [
                    'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1516321318423-f06f70fc504e?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1527239884a7-25c99e4573d5?w=300&h=300&fit=crop',
                ],
            ],
            (object) [
                'id' => 9,
                'question_text' => 'Hambatan terbesar mu dalam belajar?',
                'question_type' => 'test',
                'answer_type' => 'choice',
                'option' => ['Konsentrasi', 'Motivasi', 'Memahami materi', 'Manajemen waktu'],
            ],
            (object) [
                'id' => 10,
                'question_text' => 'Pilih goals belajar yang ingin kamu capai:',
                'question_type' => 'test',
                'answer_type' => 'image',
                'option' => [
                    'https://images.unsplash.com/photo-1507842217343-583e7270bfba?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1516321318423-f06f70fc504e?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1527239884a7-25c99e4573d5?w=300&h=300&fit=crop',
                ],
            ],
        ]);
    }
}
