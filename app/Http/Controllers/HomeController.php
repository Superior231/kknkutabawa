<?php

namespace App\Http\Controllers;

use App\Helpers\ReadTimeHelper;
use App\Models\Content;
use App\Models\Project;
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

    public function show_project($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $author = $project->user;
        $author_name = $author->fullname;
        $description = Str::limit(strip_tags($project->description), 150);
        $thumbnail = $project->thumbnail;
        $readTime = ReadTimeHelper::estimate($project->description);

        return view('pages.showProject', [
            'title' => $project->title,
            'active' => 'home',
            'project' => $project,
            'author' => $author,
            'author_name' => $author_name,
            'description' => $description,
            'keywords' => $project->category,
            'thumbnail' => $thumbnail,
            'readTime' => $readTime
        ]);
    }
}
