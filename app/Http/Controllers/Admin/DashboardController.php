<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\User;
use App\Models\Playlist;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth']);
    }

    public function index()
    {
        $stats = [
            'total_songs' => Song::count(),
            'total_users' => User::count(),
            'total_playlists' => Playlist::count(),
            'total_categories' => Category::count(),
            'recent_songs' => Song::with('category')->latest()->take(5)->get(),
            'recent_users' => User::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}