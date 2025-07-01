<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index', [
            'title' => 'KKN Desa Kutabawa 2025 | Universitas Pancasakti Tegal',
            'active' => 'home',
        ]);
    }
}
