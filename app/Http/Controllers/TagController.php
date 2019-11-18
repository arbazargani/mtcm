<?php

namespace App\Http\Controllers;

use App\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

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

    public function Archive($slug)
    {
        $tag = Tag::with('article')->where('slug', '=', $slug)->get();
        if (!count($tag)) {
            return abort('404');
        }
        return view('public.tag.archive', compact('tag'));
    }
}
