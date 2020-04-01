<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class FeedController extends Controller
{
    public function Index() {
        // $articles = Article::where('state', '=', 1)->get();
        $articles = Article::where('state', '=', 1)->orderBy('id', 'DESC')->limit(15)->get();
        $lastModified = $articles->first();
        return response()
        ->view('public.feed.index', compact(['articles', 'lastModified']))
        ->header('Content-Type','application/atom+xml; charset=UTF-8');
    }
    
    public function Category() {
        //
    }

}