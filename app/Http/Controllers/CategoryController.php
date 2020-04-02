<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    public function Manage()
    {
        $categories = Category::paginate(15);
        return view('admin.category.manage', compact('categories'));
    }

    public function Submit(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:30',
            'slug'=>'max:30'
        ]);
        $category = new Category();
        $category->name = $request['name'];
        if (isset($request['slug']) && !is_null($request['slug'])) {
            $category->slug = SlugService::createSlug(Category::class, 'slug', $request['slug']);
        }
        $category->save();
        return redirect(route('Category > Manage'));
    }

    public function Delete($id)
    {
        if ($id == 1) {
            $back = route('Category > Manage');
            return view('admin.errors.unallowed', compact('back'));
        }
        $category = Category::find($id)->delete();
        return back();
    }

    public function Archive(Request $request, $slug)
    {
        // $category = Category::with('article')->where('slug', '=', $slug)->get();
        $category = Category::with('article')->where('slug', '=', $slug)->get();
        if (!count($category)) {
          return abort('404');
        }

        //handle array of objects pagination

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        // $itemCollection = collect($items);
        $itemCollection = collect($category[0]->article->where('state', 1)->reverse());

        // Define how many items we want to be visible in each page
        $perPage = 15;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        $PaginatedCategories = $paginatedItems;

        return view('public.category.archive', compact('category', 'PaginatedCategories'));
    }
}
