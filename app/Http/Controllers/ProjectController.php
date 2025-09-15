<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('pages.project.index', [
            'title' => 'Projects - KKN Desa Kutabawa',
            'navTitle' => 'Projects',
            'active' => 'projects',
            'projects' => $projects,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        
        return view('pages.project.create', [
            'title' => 'Tambah Project - KKN Desa Kutabawa',
            'navTitle' => 'Tambah project',
            'active' => 'projects',
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:projects|max:255',
            'thumbnail' => 'image|mimes:jpg,jpeg,png,webp|max:10240|required',
            'category' => 'required',
            'description' => 'required'
        ], [
            'title.unique' => 'Judul sudah ada',
            'title.required' => 'Judul harus diisi',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berupa gambar dengan ekstensi .jpg, .jpeg, .png, atau .webp.',
            'thumbnail.max' => 'Ukuran thumbnail tidak boleh lebih dari 10MB.',
            'thumbnail.required' => 'Thumbnail harus diisi',
            'category.required' => 'Kategori harus dipilih',
            'description.required' => 'Isi konten harus diisi'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.webp';
            $image = Image::make($file)->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 80);

            Storage::disk('public')->put('thumbnails/' . $fileName, (string) $image);
            $data['thumbnail'] = $fileName;
        }
        
        $project = Project::create($data);

        if ($project) {
            return redirect()->route('project.index')->with('success', 'Project berhasil dibuat!');
        } else {
            return redirect()->route('project.index')->with('error', 'Project gagal dibuat!');
        }
    }

    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->first();
        $categories = Category::orderBy('name', 'asc')->get();

        // if (Auth::user()->roles == 'admin' || Auth::user()->id == $project->user_id) {
        //     return view('pages.project.edit', [
        //         'title' => 'Edit Project - KKN Desa Kutabawa',
        //         'navTitle' => 'Edit project',
        //         'active' => 'projects',
        //         'project' => $project,
        //         'categories' => $categories
        //     ]);
        // } else {
        //     return redirect()->route('project.index')->with('error', 'Anda tidak memiliki akses untuk mengedit project ini!');
        // }
        return view('pages.project.edit', [
            'title' => 'Edit Project - KKN Desa Kutabawa',
            'navTitle' => 'Edit project',
            'active' => 'projects',
            'project' => $project,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => [
                'required',
                Rule::unique('projects')->ignore($id),
                'max:255',
            ],
            'thumbnail' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
            'category' => 'required',
            'description' => 'required'
        ], [
            'title.unique' => 'Judul sudah ada',
            'title.required' => 'Judul harus diisi',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berupa gambar dengan ekstensi .jpg, .jpeg, .png, atau .webp.',
            'thumbnail.max' => 'Ukuran thumbnail tidak boleh lebih dari 10MB.',
            'category.required' => 'Kategori harus dipilih',
            'description.required' => 'Isi konten harus diisi'
        ]);

        $project = Project::find($id);

        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        // if (Auth::id() !== (int) $project->user_id && Auth::user()->roles !== 'admin') {
        //     return redirect()->route('project.index')->with('error', 'Oops... Terjadi kesalahan!');
        // }

        $project->category = $request->input('category', $project->category);
        $project->title = $request->input('title', $project->title);
        $project->description = $request->input('description', $project->description);
        $project['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            // Hapus file lama jika ada
            if ($project->thumbnail && Storage::disk('public')->exists('thumbnails/' . $project->thumbnail)) {
                Storage::disk('public')->delete('thumbnails/' . $project->thumbnail);
            }
        
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.webp';
            $image = Image::make($file)->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 80);
            
            Storage::disk('public')->put('thumbnails/' . $fileName, (string) $image);
            $project->thumbnail = $fileName;
        }
        
        $project->save();

        if ($project) {
            return redirect()->route('project.index')->with('success', 'Project berhasil diedit!');
        } else {
            return redirect()->route('project.index')->with('error', 'Project gagal diedit!');
        }
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        if (Auth::id() !== (int) $project->user_id && Auth::user()->roles !== 'admin') {
            return redirect()->route('project.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        if ($project->thumbnail) {
            Storage::disk('public')->delete('thumbnails/' . $project->thumbnail);
        }

        $project->delete();

        if ($project) {
            return redirect()->route('project.index')->with('success', 'Project berhasil dihapus!');
        } else {
            return redirect()->route('project.index')->with('error', 'Project gagal dihapus!');
        }
    }
}
