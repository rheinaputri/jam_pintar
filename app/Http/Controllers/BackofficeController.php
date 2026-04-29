<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BackofficeController extends Controller
{
    public function index(): View
    {
        return view('pages.backoffice.index');
    }
}