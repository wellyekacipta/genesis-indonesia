<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = \App\Models\Article::where('is_published', true)
                            ->latest()
                            ->take(3)
                            ->get();

        return view('home', compact('latestArticles'));
    }

    public function competitions()
    {
        $competitions = \App\Models\Competition::where('is_active', true)
                            ->latest()
                            ->get();

        return view('competitions.index', compact('competitions'));
    }
}
