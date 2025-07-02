<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages.profile.index', [
            'title' => 'My Profile - KKN Desa Kutabawa',
            'navTitle' => 'My Profile',
            'active' => 'my profile',
            'user' => $user
        ]);
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        $prodi = User::getProdi();
        $jobs = User::getJobs();

        return view('pages.profile.edit', [
            'title' => 'Edit Profile - KKN Desa Kutabawa',
            'navTitle' => 'Edit Profile',
            'active' => 'edit profile',
            'user' => $user,
            'prodi' => $prodi,
            'jobs' => $jobs
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:users,name,' . $id,
            'avatar' => 'image|mimes:jpg,jpeg,png,webp|max:5048',
            'password' => 'nullable|min:8|max:255',
        ], [
            'name.max' => 'Username tidak boleh lebih dari 50 karakter.',
            'name.unique' => 'Username sudah digunakan.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berupa gambar dengan ekstensi .jpg, .jpeg, .png, atau .webp.',
            'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 5MB.',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 255 karakter',
        ]);

        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        if (Auth::id() !== (int) $id) {
            return redirect()->route('profile.index')->with('error', 'Oops... Terjadi kesalahan!');
        }
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('profile.index')->with('error', 'Pengguna tidak ditemukan!');
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
            return redirect()->route('profile.index')->with('success', 'Akun berhasil diedit!');
        } else {
            return redirect()->route('profile.index')->with('error', 'Akun gagal diedit!');
        }
    }

    public function deleteAvatar($id)
    {
        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        if (Auth::id() !== (int) $id) {
            return redirect()->route('profile.index')->with('error', 'Oops... Terjadi kesalahan!');
        }
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('profile.index')->with('error', 'Pengguna tidak ditemukan!');
        }

        // Hapus file avatar jika ada
        if (!empty($user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
            $user->avatar = null;
        }

        $user->save();

        if ($user) {
            return redirect()->route('profile.index')->with('success', 'Avatar berhasil dihapus!');
        } else {
            return redirect()->route('profile.index')->with('error', 'Avatar gagal dihapus!');
        }
    }
}
