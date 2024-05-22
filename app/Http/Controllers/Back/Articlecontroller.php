<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\DataCollector\LateDataCollectorInterface;
use Yajra\DataTables\Facades\DataTables;

class Articlecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $articles = Article::with('category')->latest()->get();
    
            return DataTables::of($articles)
                    ->addIndexColumn()
                    ->addColumn('categories_id', function($articles){
                        return $articles->category->name;
                    })
                    ->addColumn('status', function($articles){
                        if ($articles->status == 0) {
                            return '<span class="bedge bg-danger">Private</span>';
                        } else {
                            return '<span class="bedge bg-success">Published</span>';
                        }                        
                    })
                    ->addColumn('button', function($articles){
                        return '<div class="text-center">
                            <a href="article/'.$articles->id.'" class="btn btn-secondary">Detail</a>
                            <a href="article/'.$articles->id.'/edit" class="btn btn-primary">Edit</a>
                            <button class="delete-article-btn btn btn-danger" data-id="'.$articles->id.'">Delete Article</button>
                        </div>';
                    })
                    
                    ->rawColumns(['categories_id', 'status', 'button']) // Corrected here
                    ->make(true);
        }
    
        return view('back.article.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.article.create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('img');
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/back', $fileName);

        $data['user_id'] = auth()->user()->id;
        $data['img'] = $fileName;
        $data['slug'] = Str::slug($data['title']);
        Article::create($data);

        return redirect(url('article'))->with('success', 'Data article has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('back.article.show',[
            'articles' => Article::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.article.update', [
            'articles' => Article::find($id),
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/back', $fileName);
    
            $data['img'] = $fileName;

            //unlink img

            Storage::delete('public/back/'.$request->oldImg );
        } else {
            $data['img'] = $request->oldImg;
        }
        
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['title']);
        Article::find($id)->update($data);

        return redirect(url('article'))->with('success', 'Data article has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Delete associated image, if any
        if ($article->img) {
            Storage::delete('public/back/' . $article->img);
        }

        // Delete the article
        $article->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Article deleted successfully']);
    
    }
}