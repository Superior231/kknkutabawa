<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('pages.index', [
            'title' => 'KKN Desa Kutabawa 2025 | Universitas Pancasakti Tegal',
            'active' => 'home',
            'users' => $users
        ]);
    }

    public function show_profile($slug)
    {
        $users = User::all();
        $user = $users->where('slug', $slug)->firstOrFail();

        return view('pages.showProfile', [
            'title' => $user->name . ' (@' . $user->slug . ') - KKN Desa Kutabawa',
            'navTitle' => '',
            'active' => '',
            'users' => $users,
            'user' => $user
        ]);
    }
}
