<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function Submit (Request $request, $id) {
      $comment = new Comment;
      $comment->content = $request['content'];
      $comment->article_id = $id;
      if (Auth::check()) {
        $request->validate([
            'content' => 'min:2',
            'website' => 'min:4'
        ]);
        $comment->user_id = Auth::user()->id;
        $comment->name = Auth::user()->name;
        $comment->family = Auth::user()->family;
        $comment->email = Auth::user()->email;
      } else {
        $request->validate([
            'name' => 'required|min:1|max:20',
            'family' => 'min:1|max:20',
            'email' => 'required|min:1',
            'website' => 'min:4',
            'content' => 'min:2'
        ]);
        $comment->name = $request['name'];
        $comment->family = $request['name'];
        $comment->email = $request['name'];
      }
      if (isset($request['website'])) {
        $comment->website = $request['website'];
      }
      $comment->save();
      return back();
    }
}
