<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $user = user::latest()->paginate(10);
        return view('user.index',compact('user'));
    }

    public function store(request $request){
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role' => request('role'),
        ]);
        return redirect()->back();
    }

    public function edit($id){
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(request $request, $id){
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        if (request()->password) {
            request()->validate([
                'password' => 'required'
            ]);
        }
        $user = User::find($id);
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role' => request('role'),
        ]);
        return redirect()->route('user.index');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}