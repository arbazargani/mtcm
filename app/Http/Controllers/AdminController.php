<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function Index() {
        return view('admin.home.index');
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
}
