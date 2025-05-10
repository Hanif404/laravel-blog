<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return inertia('User/Registration');
    }

    public function store(Request $request)
    {
        User::create($request->validate([
            'name' => 'required|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ])
    );
    return redirect()->route('articles.index')
    ->with('success', 'User was created');
    }
}
