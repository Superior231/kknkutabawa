<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index()
    {
        $content = Content::where('id', 1)->firstOrFail();
        
        return view('pages.dashboard.content', [
            'title' => 'Contents - KKN Desa Kutabawa',
            'navTitle' => 'Contents',
            'active' => 'contents',
            'content' => $content
        ]);
    }

    public function update(Request $request, $id)
    {
        $content = Content::find($id);
        if (!$content) {
            return redirect()->route('content.edit', $id)->with('error', 'Content tidak ditemukan!');
        }

        $content->label = $request->input('label', $content->label);
        $content->hero_title = $request->input('hero_title', $content->hero_title);
        $content->hero_description = $request->input('hero_description', $content->hero_description);
        $content->profile_population = $request->input('profile_population', $content->profile_population);
        $content->profile_profession = $request->input('profile_profession', $content->profile_profession);
        $content->profile_area = $request->input('profile_area', $content->profile_area);
        $content->profile_description = $request->input('profile_description', $content->profile_description);
        
        if ($request->hasFile('hero_image')) {
            // Hapus file lama jika ada
            if ($content->hero_image) {
                Storage::disk('public')->delete('thumbnails/' . $content->hero_image);
            }

            // Upload and update image
            $file = $request->file('hero_image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('thumbnails', $fileName, 'public');
            $content->hero_image = $fileName;
        }

        $content->save();

        if ($content) {
            return redirect()->route('content.index')->with('success', 'Content berhasil diedit!');
        } else {
            return redirect()->route('content.index')->with('error', 'Content gagal diedit!');
        }
    }
}
