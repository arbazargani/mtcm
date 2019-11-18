<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Comment;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function New()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.new', compact(['categories', 'tags']));
    }

    public function Submit(Request $request)
    {
        if ($request['publish']) {
            $request->validate([
                'title' => 'required|min:1|max:400',
                'content' => 'required|min:1',
                'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $fileName = 'ghost.png';
            if ($request->hasFile('cover')) {
                // Get filename.extention
                $image = $request->file('cover')->getClientOriginalName();
                // Get just file name
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                // Get just file extention
                $imageExtention = $request->file('cover')->getClientOriginalExtension();
                // Make unique file name
                $fileName = $imageName . '_' . time() . '.' . $imageExtention;
                // Store for public uses
                $path = $request->file('cover')->storeAs('public/uploads/articles/images', $fileName);
            }

            $article = new Article();
            $article->title = $request['title'];
            $article->content = $request['content'];
            $article->cover = $fileName;
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

    public function Manage()
    {
        $articles = Article::latest()->paginate(20);
        return view('admin.article.manage', compact('articles'));
    }

    public function Show($slug)
    {
        $article = Article::where('slug', '=', $slug)->get();
        if (!count($article)) {
            return abort('404');
        } else {
            Article::where('slug', '=', $slug)->increment('views');
            $comments = $article[0]->comment;
            //$comments = $this->ObjectToArray($comments, ['id', 'content', 'article_id', 'user_id', 'name', 'family', 'email', 'website', 'created_at', 'updated_at']);
            return view('public.article.single', compact(['article', 'comments']));
        }
    }

    public function Edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.edit', compact(['article', 'id', 'categories', 'tags']));
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:1|max:400',
            'content' => 'required|min:1|',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            // Get filename.extention
            $image = $request->file('cover')->getClientOriginalName();
            // Get just file name
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            // Get just file extention
            $imageExtention = $request->file('cover')->getClientOriginalExtension();
            // Make unique file name
            $fileName = $imageName . '_' . time() . '.' . $imageExtention;
            // Store for public uses
            $path = $request->file('cover')->storeAs('public/uploads/articles/images', $fileName);
        }

        $article = Article::find($id);
        $article->title = $request['title'];
        $article->content = $request['content'];
        if ($request->hasFile('cover')) {
            $article->cover = $fileName;
        }
        $article->save();
        $article->category()->sync($request['categories']);
        $article->tag()->sync($request['tags']);
        return redirect(route('Article > Edit', $id));
    }

    public function Delete($id)
    {
        // $article = Article::find($id)->delete();
        $article = Article::find($id);
        Storage::delete('public/uploads/articles/images/' . $article->cover);
        $article->delete();
        return back();
    }


    /**
     * Define Custom methods to do some magics!
     */
    private function ObjectToArray(object $object, array $properties)
    {
        $array = array();
        $objects = $object;
        foreach ($objects as $current) {
            foreach ($properties as $property) {
                $array[][$property] = $current->$property;
            }
        }
        return $array;
    }
}
