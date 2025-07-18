<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'title' => 'Dashboard - KKN Desa Kutabawa',
            'navTitle' => 'Dashboard',
            'active' => 'dashboard',
        ]);
    }
}
