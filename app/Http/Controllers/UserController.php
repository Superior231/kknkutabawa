<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function create()
    {
        $jobs = User::getJobs();
        $prodi = User::getProdi();

        return view('pages.user.create', [
            'title' => 'Tambah User - KKN Desa Kutabawa',
            'navTitle' => 'Tambah User',
            'active' => 'user',
            'jobs' => $jobs,
            'prodi' => $prodi
        ]);
    }
    
    public function store(Request $request)
    {
        $validatedData =$request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:users'],
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
        ], [
            'name.unique' => 'Nama sudah digunakan',
            'name.required' => 'Nama harus diisi',
            'slug.unique' => 'Slug sudah digunakan',
            'slug.max' => 'Slug terlalu panjang',
            'jobs.string' => 'Pekerjaan harus berupa string',
            'jobs.max' => 'Pekerjaan terlalu panjang',
            'prodi.string' => 'Prodi harus berupa string',
            'prodi.max' => 'Prodi terlalu panjang',
            'description.string' => 'Deskripsi harus berupa string',
            'instagram.url' => 'Instagram harus berupa url',
            'facebook.url' => 'Facebook harus berupa url',
            'linkedin.url' => 'LinkedIn harus berupa url',
            'tiktok.url' => 'TikTok harus berupa url',
            'twitter.url' => 'Twitter harus berupa url',
            'roles.in' => 'Roles harus berupa user atau admin',
            'status.in' => 'Status harus berupa approved atau suspend',
            'password.min' => 'Password terlalu pendek',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['slug'] = Str::slug($validatedData['name']);

        $user = User::create($validatedData);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
        } else {
            return redirect()->route('user.index')->with('error', 'User gagal ditambahkan!');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $jobs = User::getJobs();
        $prodi = User::getProdi();

        if ($user) {
            return view('pages.user.edit', [
                'title' => 'Edit User - KKN Desa Kutabawa',
                'navTitle' => 'Edit User',
                'active' => 'user',
                'user' => $user,
                'jobs' => $jobs,
                'prodi' => $prodi
            ]);
        } else {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan!');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:users,name,' . $id,
            'avatar' => 'image|mimes:jpg,jpeg,png,webp|max:5048',
            'password' => 'nullable|min:8|max:255',
        ], [
            'name.max' => 'Username tidak boleh lebih dari 30 karakter.',
            'name.unique' => 'Username sudah digunakan.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berupa gambar dengan ekstensi .jpg, .jpeg, .png, atau .webp.',
            'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 5MB.',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 255 karakter',
        ]);
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan!');
        }

        // Slug
        $oldName = $user->name;
        $newName = $request->input('name', $user->name);
        $user->name = $newName;
        if ($oldName !== $newName) {
            $user->slug = Str::slug($newName);
        }

        $user->jobs = $request->input('jobs', $user->jobs);
        $user->prodi = $request->input('prodi', $user->prodi);
        $user->description = $request->input('description', $user->description);
        $user->instagram = $request->input('instagram', $user->instagram);
        $user->facebook = $request->input('facebook', $user->facebook);
        $user->linkedin = $request->input('linkedin', $user->linkedin);
        $user->twitter = $request->input('twitter', $user->twitter);
        $user->tiktok = $request->input('tiktok', $user->tiktok);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            // Upload and update avatar
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $fileName;
        }
        
        $user->save();

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User berhasil diedit!');
        } else {
            return redirect()->route('user.index')->with('error', 'User gagal diedit!');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!empty($user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        $user->delete();

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
        } else {
            return redirect()->route('user.index')->with('error', 'User gagal dihapus!');
        }
    }

    public function deleteAvatarUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Pengguna tidak ditemukan!');
        }

        // Hapus file avatar jika ada
        if (!empty($user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
            $user->avatar = null;
        }

        $user->save();

        if ($user) {
            return redirect()->route('user.index')->with('success', 'Avatar berhasil dihapus!');
        } else {
            return redirect()->route('user.index')->with('error', 'Avatar gagal dihapus!');
        }
    }
}
