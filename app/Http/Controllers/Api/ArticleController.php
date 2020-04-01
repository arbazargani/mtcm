<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function All() {
        $articles = Article::latest()->paginate(2);
        return ArticleResource::collection($articles);
    }
    public function Show($id) {
        $article = Article::findOrFail($id);
        return new ArticleResource($article);
    }
    public function New(Request $request) {
        if($request->isMethod('post')) {
            $article = new Article;
            $article->title = $request->title;
            $article->content = $request->content;
        } else {
            return response('Method Not Allowed.', 405)
                   ->header('Content-Type', 'text/plain');
        }
    }
    public function Update($id) {
        $article = Article::findOrFail($id);
        return new ArticleResource($article);
    }
    public function Delete() {
        $articles = Article::Delete($id);
        return ArticleResource::collection($articles);
    }
}
