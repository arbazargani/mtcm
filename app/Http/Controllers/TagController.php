<?php

namespace App\Http\Controllers;

use App\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TagController extends Controller
{
    public function Manage()
    {
        $tags = Tag::paginate(20);
        return view('admin.tag.manage', compact('tags'));
    }

    public function Submit(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:30',
            'slug'=>'max:30'
        ]);
        $tag = new Tag();
        $tag->name = $request['name'];
        if (isset($request['slug']) && !is_null($request['slug'])) {
            $tag->slug = SlugService::createSlug(Tag::class, 'slug', $request['slug']);
        }
        $tag->save();
        return redirect(route('Tag > Manage'));
    }

    public function Delete($id)
    {
        $tag = Tag::find($id)->delete();
        return back();
    }

    public function Archive(Request $request, $slug)
    {
        $tag = Tag::with('article')->where('slug', '=', $slug)->get();
        if (!count($tag)) {
          return abort('404');
        }

        //handle array of objects pagination

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        // $itemCollection = collect($items);
        $itemCollection = collect($tag[0]->article->where('state', 1)->reverse());

        // Define how many items we want to be visible in each page
        $perPage = 10;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        $PaginatedTags = $paginatedItems;
  
        return view('public.tag.archive', compact('tag', 'PaginatedTags'));
    }
}
