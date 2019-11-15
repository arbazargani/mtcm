<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function New() {
        return view('admin.page.new');
    }
    public function Submit(Request $request) {
        if ($request['publish']) {
            $request->validate([
                'title' => 'required|min:1|max:400',
                'content' => 'required|min:1'
            ]);
            $page = new Page();
            $page->title = $request['title'];
            $page->content = $request['content'];
            $page->user_id = Auth::id();
            $page->save();
        }
        if ($request['draft']) {
            return 'drafted.';
        }

        return redirect(route('Page > Edit', $page->id));
    }
    public function Manage()
    {
        $pages = Page::paginate(20);
        return view('admin.page.manage', compact('pages'));
    }
    public function Show($slug) {
        $page = Page::where('slug', '=', $slug)->get();
        if (!count($page)) {
            return abort('404');
        }
        return view('public.page.single', compact('page'));
    }
    public function Edit($id) {
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }
    public function Update(Request $request, $id) {
        $request->validate([
            'title' => 'required|min:1|max:400',
            'content' => 'required|min:1|'
        ]);
        $page = Page::find($id);
        $page->title = $request['title'];
        $page->content = $request['content'];
        $page->save();
        return redirect(route('Page > Edit', $id));
    }
    public function Delete($id) {
        $page = Page::find($id)->delete();
        return back();
    }
}
