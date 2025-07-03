<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $contents = Content::all();
        $content = $contents->first();

        return view('pages.index', [
            'title' => 'KKN Desa Kutabawa 2025 | Universitas Pancasakti Tegal',
            'active' => 'home',
            'users' => $users,
            'contents' => $contents,
            'content' => $content
        ]);
    }

    public function show_profile($slug)
    {
        $users = User::all();
        $user = $users->where('slug', $slug)->first();
        if (!$user) {
            abort(404);
        }

        return view('pages.showProfile', [
            'title' => $user->fullname . ' (@' . $user->slug . ') - KKN Desa Kutabawa',
            'navTitle' => '',
            'active' => '',
            'users' => $users,
            'user' => $user
        ]);
    }
}
