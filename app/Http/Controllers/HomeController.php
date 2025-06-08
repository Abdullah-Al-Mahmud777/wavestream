<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Feedback;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredSongs = Song::with('category')
            ->latest()
            ->take(6)
            ->get();

        $recentFeedback = Feedback::latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredSongs', 'recentFeedback'));
    }
}