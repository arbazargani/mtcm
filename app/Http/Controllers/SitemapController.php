<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Page;
use App\Category;
use App\Tag;

class SitemapController extends Controller
{
    public function Index() {
        return response()
            ->view('public.sitemap.index')
            ->header('Content-Type','text/xml');

    }

    public function Article() {
        $articles = Article::where('state', '=', 1)->get();
        return response()
            ->view('public.sitemap.article', compact('articles'))
            ->header('Content-Type','text/xml');
    }

    public function Page() {
        $pages = Page::all();
        return response()
            ->view('public.sitemap.page', compact('pages'))
            ->header('Content-Type','text/xml');
    }

    public function Category() {
        $categories = Category::all();
        return response()
            ->view('public.sitemap.category', compact('categories'))
            ->header('Content-Type','text/xml');
    }

    public function Tag() {
        $tags = Tag::all();
        return response()
            ->view('public.sitemap.tag', compact('tags'))
            ->header('Content-Type','text/xml');
    }
}

