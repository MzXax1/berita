<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('back.dashboard.index', [
            'total_articles' =>Article::count(),
            'total_categories' =>Category::count(),
            'latest_articles' => Article::with('Category')->whereStatus(1)->latest()->take(5)->get(),
            'popular_articles' => Article::with('Category')->whereStatus(1)->orderBy('views', 'desc')->take(5)->get(),
        ]);
    }

    public function show()
    {
        if (Auth::check()) {
            $user = Auth::user()->role; // Mengambil data role dari pengguna yang sedang login
            return view('back.dashboard.index', compact('user'));
        } else {
            // Handle case when user is not logged in
            return redirect()->route('login');
        }
    }

    
}
