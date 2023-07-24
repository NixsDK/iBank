<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->isFirstTimeLogin()) {
            return view('home', ['showWelcomePopup' => true]);
        }

        return view('home', ['showWelcomePopup' => false]);
    }
}
