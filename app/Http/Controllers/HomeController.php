<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $contents = Content::all();
        $content = $contents->first();
        $description = $description = Str::limit(strip_tags($content->hero_description), 150);;

        return view('pages.index', [
            'title' => 'KKN Desa Kutabawa 2025 | Universitas Pancasakti Tegal',
            'active' => 'home',
            'users' => $users,
            'contents' => $contents,
            'content' => $content,
            'description' => $description
        ]);
    }

    public function show_profile($slug)
    {
        $users = User::all();
        $user = $users->where('slug', $slug)->first();
        if (!$user) {
            abort(404);
        }
        
        $description = Str::limit(strip_tags($user->description), 150);

        return view('pages.showProfile', [
            'title' => $user->fullname . ' (@' . $user->slug . ') - KKN Desa Kutabawa',
            'navTitle' => '',
            'active' => '',
            'users' => $users,
            'user' => $user,
            'description' => $description
        ]);
    }
}
