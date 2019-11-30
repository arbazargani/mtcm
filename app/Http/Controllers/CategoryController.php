<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function Manage()
    {
        $categories = Category::paginate(20);
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

    public function Archive($slug)
    {
        $category = Category::with('article')->where('slug', '=', $slug)->get();
        if (!count($category)) {
          return abort('404');
        }
        return view('public.category.archive', compact('category'));
    }
}
