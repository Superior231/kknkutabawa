<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Content::create([
            'label' => "Kerjasama, Kolaborasi, Kreativitas",
            'hero_image' => null,
            'hero_title' => "KKN Desa Kutabawa Tahun 2025",
            'hero_description' => "Universitas Pancasakti Tegal",
            'profile_population' => "8656",
            'profile_profession' => "Petani",
            'profile_area' => "762",
            'profile_description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, doloremque.",
        ]);
    }
}
