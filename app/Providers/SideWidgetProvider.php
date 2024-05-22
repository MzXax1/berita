<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class SideWidgetProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('front.layout.side-widget', function ($view) {
            // $categories = Category::latest()->get();
            $categories = Category::whereHas('Articles', function (Builder $query) {
                $query->where('status', 1);
            })->withCount(['Articles' => function($query){
                $query->where('status', 1);
            }])->latest()->get();
            $view->with('categories', $categories);
        });


        View::composer('front.layout.side-widget', function ($view) {
            $post = Article::orderBy('views', 'desc')->take(5)->get();
            $view->with('popular_post', $post);
        });
        


        View::composer('front.layout.navbar', function ($view) {
            $categories = Category::latest()->take(3)->get();
            $view->with('category_navbar', $categories);
        });
        

        
    }
}
