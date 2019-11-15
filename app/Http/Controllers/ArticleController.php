<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function New() {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.new', compact(['categories', 'tags']));
    }
    public function Submit(Request $request) {
        if ($request['publish']) {
            $request->validate([
                'title' => 'required|min:1|max:400',
                'content' => 'required|min:1',
                'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $coverURL = 'ghost.jpg';
            if ($request->hasFile('cover')) {
                $coverURL = time().'.'.$request->cover->extension();
                $request->cover->move(public_path('/uploads/images/cover'), $coverURL);
            }

            $article = new Article();
            $article->title = $request['title'];
            $article->content = $request['content'];
            $article->cover = $coverURL;
            $article->user_id = Auth::id();
            $article->save();
            $article->category()->attach($request['categories']);
            $article->tag()->attach($request['tags']);
        }
        if ($request['draft']) {
            return 'drafted.';
        }

        return redirect(route('Article > Edit', $article->id));
    }
    public function Manage() {
        $articles = Article::latest()->paginate(20);
        return view('admin.article.manage', compact('articles'));
    }
    public function Show($slug) {
        $article = Article::where('slug', '=', $slug)->get();
        if (!count($article)) {
            return abort('404');
        } else {
          Article::where('slug', '=', $slug)->increment('views');
          return view('public.article.single', compact('article'));
        }
    }
    public function Edit($id) {
        $article = Article::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.edit', compact(['article', 'id', 'categories', 'tags']));
    }
    public function Update(Request $request, $id) {
        $request->validate([
            'title' => 'required|min:1|max:400',
            'content' => 'required|min:1|'
        ]);
        $article = Article::find($id);
        $article->title = $request['title'];
        $article->content = $request['content'];
        $article->save();
        $article->category()->sync($request['categories']);
        $article->tag()->sync($request['tags']);
        return redirect(route('Article > Edit', $id));
    }
    public function Delete($id) {
        $article = Article::find($id)->delete();
        return back();
    }
}
