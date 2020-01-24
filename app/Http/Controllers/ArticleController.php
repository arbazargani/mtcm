<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Comment;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function Composer\Autoload\includeFile;

class ArticleController extends Controller
{
    public function All() {
        $articles = Article::latest()->where('state', '=', 1)->paginate(2);
        return ArticleResource::collection($articles);
    }
    public function New()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.new', compact(['categories', 'tags']));
    }

    public function Submit(Request $request)
    {
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
        if ($request['publish']) {
            $article->state = 1;
            $article->previous_state = 1;
        }
        if ($request['draft']) {
            $article->state = 0;
            $article->previous_state = 0;
        }
        $article->save();
        $article->category()->attach($request['categories']);
        $article->tag()->attach($request['tags']);

        return redirect(route('Article > Edit', $article->id));
    }

    public function Manage(Request $request)
    {
         // $articles = Article::where('state', '1')->latest()->pluck('id');
         // $ids = [];
         // foreach ($articles as $id) {
         //     $ids[] = $id;
         // }
        // to fetch deleted items
        if ($request->has('state') && $request['state'] == '-1') {
            $articles = Article::where('state', '-1')->latest()->paginate(15);
        }
        // to fetch drafted items
        elseif ($request->has('state') && $request['state'] == '0') {
            $articles = Article::where('state', '0')->latest()->paginate(15);
        }
        // to fetch all items [except deleted]
        else {
            $articles = Article::where('state', '!=', -1)->latest()->paginate(15);
        }
        return view('admin.article.manage', compact('articles'));
    }

    public function Show($slug)
    {
        $article = Article::where('slug', '=', $slug)->get();
        if (!count($article) || ($article[0]->state !== 1)) {
            return abort('404', 'Not Found.');
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
        if ($request['draft']) {
            $article->state = $article->previous_state;
            $article->state = 0;
        }
        if ($request['publish']) {
            $article->state = $article->previous_state;
            $article->state = 1;
        }
        $article->save();
        $article->category()->sync($request['categories']);
        $article->tag()->sync($request['tags']);
        return redirect(route('Article > Edit', $id));
    }

    public function DeletePermanently($id)
    {
        $article = Article::find($id);
        $article->previous_state = $article->state;
        $article->state=-1;
        $article->save();
        return back();
    }

    public function Delete($id)
    {
        // $article = Article::find($id)->delete();
        $article = Article::find($id);
        Storage::delete('public/uploads/articles/images/' . $article->cover);
        $article->delete();
        return back();
    }

    public function Restore($id)
    {
        $article = Article::find($id);
        $article->state = $article->previous_state;
        $article->save();
        return back();
    }


    /**
     * Define custom methods to do some magics!
     * Not finished yet ...
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
