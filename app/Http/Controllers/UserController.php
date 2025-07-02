<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $jobs = User::getJobs();
        $prodi = User::getProdi();

        return view('pages.user.index', [
            'title' => 'Users - KKN Desa Kutabawa',
            'navTitle' => 'Users',
            'active' => 'users',
            'users' => $users,
            'jobs' => $jobs,
            'prodi' => $prodi
        ]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'slug' => ['required', 'string', 'max:255', 'unique:users'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
            'jobs' => ['nullable', 'string', 'max:255'],
            'prodi' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'instagram' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'tiktok' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'roles' => ['required', 'string', 'in:user,admin'],
            'status' => ['required', 'string', 'in:approved,suspend'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'avatar' => $request->avatar ? $request->file('avatar')->store('avatars', 'public') : null,
            'jobs' => $request->jobs,
            'prodi' => $request->prodi,
            'description' => $request->description,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'tiktok' => $request->tiktok,
            'twitter' => $request->twitter,
            'roles' => $request->roles,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
}
