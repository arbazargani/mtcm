<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Article;
use App\Category;
use App\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // auth middleware for entire application
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Index(Request $request)
    {
        $sliderArticles = Article::latest()->where('state', 1)->limit(5)->get();
        $homeTitle = Setting::where('name', 'meta_title')->first();
        $homeDescription = Setting::where('name', 'meta_description')->first();

        if ($request->isMethod('get')) {
            if ($request->has('query') && !is_null($request['query'])) {
                $query = $request['query'];
                $articles = Article::where([
                    ['state', '=', 1],
                    ['title', 'LIKE', '%' . $query . '%']
                ])->orWhere([
                    ['state', '=', 1],
                    ['content', 'LIKE', '%' . $query . '%']
                ])->paginate(10);
                return view('public.home.search', compact('articles'));
            }
        }

        return view('public.home.index', compact(['sliderArticles', 'homeTitle', 'homeDescription']));
    }

    /**
     * @param $query
     */
    public function Search($query) {

    }
}
