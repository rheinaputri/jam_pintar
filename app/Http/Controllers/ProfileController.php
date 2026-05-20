<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // public function show()
    // {
    //     $user = auth()->user();
    //     return view('pages.student.profile', compact('user'));
    // }
    public function index()
    {
        $user = auth()->user()->load('city');

        $latestAttempt = $user->testAttempts()
            ->with('result.recommendation')
            ->latest()
            ->first();

        $result = $latestAttempt?->result;

        return view('pages.student.profile', compact(
            'user',
            'result'
        ));
    }
}
