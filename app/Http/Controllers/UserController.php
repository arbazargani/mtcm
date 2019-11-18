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

    public function logout()
    {
        Auth::logout();
        return redirect(route('Home'));
	}
}
