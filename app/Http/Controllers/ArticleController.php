<?php

namespace App\Http\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function Composer\Autoload\includeFile;
use Illuminate\Support\Facades\Log;

use App\Article;
use App\Category;
use App\Comment;
use App\Tag;
use App\User;

class ArticleController extends Controller
{
    public function All() {
        $articles = Article::latest()->where('state', '=', 1)->paginate(2);
        return ArticleResource::collection($articles);
    }

    public function NoArabic($input) {
        $output = str_replace('ي', 'ی', $input);
        $output = str_replace('ك', 'ک', $output);
        return $output;
    }

    public function NoRelatives($input) {
        $relative = 'src="../../';
        $absolute = 'src="'.ENV('APP_URL')."/";
        $output = str_replace($relative, $absolute , $input);
        return $output;
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
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->has('new_categories') && count($request['new_categories']) > 0) {
            $user_categories = [];
            foreach ($request['new_categories'] as $value) {
                if (!is_null($value)) {
                    $category = new Category();
                    $category->name = $value;
                    $category->slug = SlugService::createSlug(Category::class, 'slug', $value);
                    $category->save();
                    $user_categories[] = $category->id;
                }
            }
        }

        if($request->has('new_tags') && count($request['new_tags']) > 0) {
            $user_tags = [];
            foreach ($request['new_tags'] as $value) {
                if (!is_null($value)) {
                    $tag = new Tag();
                    $tag->name = $value;
                    $tag->slug = SlugService::createSlug(Category::class, 'slug', $value);
                    $tag->save();
                    $user_tags[] = $tag->id;
                }
            }
        }


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
        $article->title = $this->NoArabic($request['title']);
        $article->content = $this->NoArabic($request['content']);
        $article->content = $this->NoRelatives($request['content']);

        $article->meta_description = isset($request['meta-description']) ? $this->noArabic($request['meta-description']) : '';
        $article->meta_robots = isset($request['meta-robots']) ? $request['meta-robots'] : 'index, follow';

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

        if (isset($user_categories) && count($user_categories) > 0) {
            $article->category()->attach($user_categories);
        }

        $article->tag()->attach($request['tags']);

        if (isset($user_tags) && count($user_tags) > 0) {
            $article->tag()->attach($user_tags);
        }

        $log = $article->created_at . " - article created. | id:" . $article->id . " | state:";
        $log .= $article->state ? 'published' : 'draft';

        Log::info($log);

        return redirect(route('Article > Edit', $article->id));
    }

    public function Manage(Request $request)
    {
        $categories = Category::all();
        $tags = Category::all();
        $users = User::all();

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
        return view('admin.article.manage', compact(['articles', 'categories', 'tags', 'users']));
    }

    public function Show($slug, Request $request)
    {
//        $article = Article::where('slug', '=', $slug)->get();

        $article = Article::with('comment')->where('slug', '=', $slug)->get();

        if (!count($article) || ($article[0]->state !== 1)) {
            return abort('404', 'Not Found.');
        } else {
            Article::where('slug', '=', $slug)->increment('views');

            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            // Create a new Laravel collection from the array data
            // $itemCollection = collect($items);
            $itemCollection = collect($article[0]->comment->where('approved', 1)->reverse());

            // Define how many items we want to be visible in each page
            $perPage = 15;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

            // set url path for generted links
            $paginatedItems->setPath($request->url());

            $comments = $paginatedItems;

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

        if($request->has('new_categories') && count($request['new_categories']) > 0) {
            $user_categories = [];
            foreach ($request['new_categories'] as $value) {
                if (!is_null($value)) {
                    $category = new Category();
                    $category->name = $value;
                    $category->slug = SlugService::createSlug(Category::class, 'slug', $value);
                    $category->save();
                    $user_categories[] = $category->id;
                }
            }
        }

        if($request->has('new_tags') && count($request['new_tags']) > 0) {
            $user_tags = [];
            foreach ($request['new_tags'] as $value) {
                if (!is_null($value)) {
                    $tag = new Tag();
                    $tag->name = $value;
                    $tag->slug = SlugService::createSlug(Category::class, 'slug', $value);
                    $tag->save();
                    $user_tags[] = $tag->id;
                }
            }
        }

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

        $article->title = $this->NoArabic($request['title']);
        $article->content = $this->NoArabic($request['content']);
        $article->content = $this->noRelatives($request['content']);

        $article->meta_description = isset($request['meta-description']) ? $this->NoArabic($request['meta-description']) : '';
        $article->meta_robots = isset($request['meta-robots']) ? $request['meta-robots'] : 'index, follow';

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

        if (isset($user_categories) && count($user_categories) > 0) {
            $article->category()->attach($user_categories);
        }

        $article->tag()->sync($request['tags']);

        if (isset($user_tags) && count($user_tags) > 0) {
            $article->tag()->attach($user_tags);
        }

        return redirect(route('Article > Edit', $id));
    }

    public function DeleteTemporary($id)
    {
        $article = Article::find($id);
        $article->previous_state = $article->state;
        $article->state=-1;
        $article->save();
        return back();
    }

    public function DeletePermanently($id)
    {
        $article = Article::where('id',$id)->delete($id);
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
