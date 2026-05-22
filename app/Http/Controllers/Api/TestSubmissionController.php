<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TestAttempt;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TestSubmissionController extends Controller
{
    /**
     * Submit test answers
     * 
     * Expected payload:
     * {
     *   "answers": {
     *     "question_id": "answer_value",
     *     ...
     *   }
     * }
     */
    public function submit(Request $request): JsonResponse
    {
        try {
            // Try to get user from Auth OR from request
            $user = Auth::user();
            
            // If not authenticated, try to get user_id from request and find user
            if (!$user && $request->has('user_id')) {
                $user = \App\Models\User::find($request->input('user_id'));
                Log::info('User retrieved from request', ['user_id' => $request->input('user_id')]);
            }
            
            if (!$user) {
                Log::warning('Unauthenticated test submission attempt', [
                    'ip' => $request->ip(),
                    'user_id_from_request' => $request->input('user_id'),
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi. Silakan login terlebih dahulu.',
                    'error_code' => 'UNAUTHENTICATED',
                ], 401);
            }

            // Validasi input
            $validated = $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'required|string',
                'test_type' => 'nullable|string',
            ]);

            // Buat test attempt baru
            $testAttempt = TestAttempt::create([
                'user_id' => $user->id,
                'started_at' => now()->subMinutes(rand(5, 30)),
                'finished_at' => now(),
            ]);

            // Simpan semua jawaban ke database
            foreach ($validated['answers'] as $questionId => $answer) {
                Answer::create([
                    'test_attempt_id' => $testAttempt->id,
                    'question_id' => (int) $questionId,
                    'answer' => $answer,
                ]);
            }

            Log::info('Test attempt created', [
                'test_attempt_id' => $testAttempt->id,
                'user_id' => $user->id,
                'answer_count' => count($validated['answers']),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Test berhasil diserahkan dan disimpan ke database',
                'data' => [
                    'test_attempt_id' => $testAttempt->id,
                    'submitted_at' => $testAttempt->finished_at,
                    'total_answers' => count($validated['answers']),
                ],
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Test submission validation error', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Test submission error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user's test attempts
     */
    public function getUserAttempts(): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi',
                ], 401);
            }

            $attempts = TestAttempt::where('user_id', $user->id)
                ->with('answers.question', 'result')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $attempts,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get specific test attempt details
     */
    public function getAttemptDetails($attemptId): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi',
                ], 401);
            }

            $attempt = TestAttempt::where('user_id', $user->id)
                ->where('id', $attemptId)
                ->with('answers.question', 'result')
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $attempt,
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Test attempt tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
