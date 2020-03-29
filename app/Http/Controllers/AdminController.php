<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

use App\User;
use App\Article;
use App\Page;
use App\Comment;
use App\Setting;

class AdminController extends Controller
{
    public function Index(Request $request) {
        $articles = [
            'all' => Article::all()->count(),
            'published' => Article::where('state', 1)->count(),
            'drafts' => Article::where('state', 0)->count(),
            'deleted' => Article::where('state', -1)->count(),
            'popular' => Article::orderBy('views', 'desc')->take(5)->get()
        ];

        $pages = [
            'all' => Page::all()->count(),
            'published' => Page::where('state', 1)->count(),
            'drafts' => Page::where('state', 0)->count(),
            'deleted' => Page::where('state', -1)->count()
        ];

        $comments = [
            'all' => Comment::all()->count(),
            'approved' => Comment::where('approved', 1)->count(),
            'unapproved' => Comment::where('approved', 0)->count(),
        ];

        $google_analytics_id = Setting::where('name', 'google_analyitics_client-id')->pluck('value');

        $date = new Carbon($request->get('date', today()));
        $filePath = storage_path("logs/laravel-{$date->format('Y-m-d')}.log");
        $logs = [];

        if (File::exists($filePath)) {
            $logs = [
                'lastModified' => new Carbon(File::lastModified($filePath)),
                'name' => File::name($filePath),
                'size' => File::size($filePath),
                'file' => File::get($filePath)
            ];
        }

        
        return view('admin.home.index', compact(['articles', 'pages', 'comments', 'logs']));
    }
}
