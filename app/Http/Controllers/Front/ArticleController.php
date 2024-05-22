<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $keyword = request()->keyword;
        
        if ($keyword) {
            $articles = Article::with('Category')
            ->whereStatus(1)
            ->where('title', 'like', '%' .$keyword. '%')
            ->latest()
            ->paginate(6);
        } else {
            $articles = Article::with('Category')->whereStatus(1)->latest()->paginate(6);
        }

        return view('front.article.index',[
            'articles' => $articles,
            'keyword' => $keyword
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {   
        $articles = Article::whereSlug($slug)->firstOrFail();

        // Check if article exists
        $articles->increment('views');

        $date = Carbon::parse($articles->created_at)->locale('id');

        return view('front.article.show', [
            'articles' => $articles, // Pass the found article to the view
            'formattedDate' => $date->translatedFormat('l, d-m-Y')
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
