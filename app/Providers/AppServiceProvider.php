<?php

namespace App\Providers;

use App\Category;
use App\Tag;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        view()->share(['categories'=> $categories, 'tags' => $tags]);
    }
}
