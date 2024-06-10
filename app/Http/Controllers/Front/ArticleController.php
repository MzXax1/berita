<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    // Retrieve the article by slug
    $article = Article::whereSlug($slug)->firstOrFail();
    
    // Retrieve comments related to the specific article, eager loading the user relationship
    $comments = Comment::with('replies')->where('slug', $article->slug)->whereNull('parent_id')->get();
    
    // Check if there are any comments
    if ($comments->isEmpty()) {
        // Handle case when no comments are found
        // You can return a message or redirect to a different page
    }

    // Format the created_at date
    $date = Carbon::parse($article->created_at)->locale('id');
    
    return view('front.article.show', [
        'article' => $article, // Pass the found article to the view
        'comments' => $comments, // Pass the retrieved comments to the view
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

    public function add_comment(Request $request, $slug)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);

        // Retrieve the article by slug
        $article = Article::whereSlug($slug)->firstOrFail();

        // Create a new comment instance associated with the article
        $comment = new Comment();
        $comment->slug = $article->slug; // Set the comment's slug to the article's slug
        $comment->comment = $validatedData['comment'];
        $comment->user_id = auth()->user()->id; // Set the user_id attribute using object syntax

        // Save the comment
        $comment->save();

        return redirect()->back()->with('message', 'Comment added successfully!');
    }


    public function add_reply(Request $request, $slug)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'commentId' => 'required|exists:comments,id',
            'reply' => 'required|string',
        ]);

        // Retrieve the parent comment
        $parentComment = Comment::findOrFail($validatedData['commentId']);

        // Create a new reply comment
        $reply = new Comment();
        $reply->parent_id = $parentComment->id; // Set the parent_id to the parent comment’s id
        $reply->comment = $validatedData['reply'];
        $reply->user_id = auth()->user()->id; // Assuming user authentication is set up
        $reply->slug = $slug; // Set the slug to the current article's slug

        // Save the reply
        $reply->save();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Reply added successfully!');
    }

    public function destroyComment(Request $request, $slug, $commentId)
    {
        // Temukan komentar berdasarkan ID
        $comment = Comment::findOrFail($commentId);

        // Periksa apakah pengguna memiliki izin untuk menghapus komentar
        // Misalnya, Anda mungkin ingin memeriksa apakah pengguna adalah pemilik komentar atau memiliki izin yang sesuai
        // Di sini, Anda harus menambahkan logika otorisasi sesuai dengan kebutuhan aplikasi Anda

        // Hapus komentar
        $comment->delete();

        // Kirimkan respon sukses
        return redirect()->back()->with('message', 'Delete Successfully');
    }

    
    
}
