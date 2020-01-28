<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Archive($username)
    {
        $user = User::where('username', '=', $username)->get();
        $articles = $user[0]->article;
        // return view('public.user.archive', compact(['articles'], 'user'));
        return view('public.user.archive', compact(['articles', 'user']));
    }
    public function Manage(Request $request) {
      if ($request->has('rule')) {
        if ($request['rule'] == 'admin') {
          $users = User::where('rule', 'admin')->paginate(15);
        }
        if ($request['rule'] == 'member') {
          $users = User::where('rule', 'member')->paginate(15);
        }
      } else {
        $users = User::paginate(15);
      }
      return view('admin.user.manage', compact('users'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('Home'));
     }
     public function Profile() {
         $user = User::where('id', '=', Auth::id())->get();
     	   return view('admin.profile.edit', compact('user'));
     }

     public function Update(Request $request)
     {
         $request->validate([
             'name' => 'required|min:1|max:30',
         ]);
         $user = User::find(Auth::id());
         $user->name = $request['name'];
         $user->update();
         return redirect(route("Profile"));
     }
     public function Lock(Request $request, $id)
     {
         $user = User::find($id);
         $user->state = 0;
         $user->update();
         return redirect(route("Users > Manage"));
     }
     public function Unlock(Request $request, $id)
     {
         $user = User::find($id);
         $user->state = 1;
         $user->update();
         return redirect(route("Users > Manage"));
     }
     public function Delete(Request $request, $id) {
       if (Auth::user()->rule == 'admin' && Auth::user()->id != $id) {
         User::find($id)->delete();
       } else {
         return abort(403, 'Unallowed action.');
       }
       return view('admin.user.manage', compact('users'));
     }
}
