<?php

namespace App\Http\Controllers;

use App\Models\Question;
// import model question
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // method untuk menampilkan semua question
    public function index()
    {
        $questions = Question::all();

        return view('pages.backoffice.question', compact('questions'));
    }

    public function create()
    {
        return view('pages.backoffice.question_create');
    }

    public function store(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'question_text' => 'required|string',

            'question_type' => 'required|in:kuisioner,feedback',

            'option' => 'nullable|string',

            'answer_type' => 'required|in:choice,essay',
        ]);

        // hanya simpan option jika bukan essay dan option diisi
        $validatedData['option'] =
        $request->answer_type !== 'essay' && $request->option
            ? explode(',', $request->option)
            : null;

        // simpan data
        Question::create($validatedData);

        // redirect dengan success message
        return redirect()
            ->route('backoffice.question')
            ->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()
            ->route('backoffice.question')
            ->with('success', 'Pertanyaan berhasil dihapus!');
    }

    // EDIT
    public function edit(Question $question)
    {
        return view('pages.backoffice.question_edit', compact('question'));
    }

    // UPDATE
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required',
            'question_type' => 'required|in:kuisioner,feedback',
            'answer_type' => 'required|in:choice,essay',
            'option' => 'nullable|string',
        ]);

        $question->update([
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'answer_type' => $validated['answer_type'],

            // TANPA json_encode
            'option' => $request->option
                ? explode(',', $request->option)
                : null,
        ]);

        return redirect()
            ->route('backoffice.question')
            ->with('success', 'Pertanyaan berhasil diperbarui');
    }

    public function show(Question $question)
    {
        // show detail question
        return view('pages.backoffice.question_show', compact('question'));
    }
}
