<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'avatar',
        'jobs',
        'prodi',
        'description',
        'instagram',
        'facebook',
        'linkedin',
        'tiktok',
        'twitter',
        'roles',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getJobs(): array
    {
        return [
            "Dosen Pembimbing Lapangan", "Koordinator Desa", "Wakil Koordinator Desa", "Sekertaris", "Bendahara", "Perlengkapan", "PDD", "Pilar Ekonomi", "Pilar Jati Diri", "Pilar Kesehatan", "Pilar Lingkungan", "Pilar Pendidikan"
        ];
    }

    public static function getProdi(): array
    {
        return [
            "Bimbingan dan Konseling", "Bisnis Digital", "Manajemen", "Ilmu Hukum", "Informatika", "Pendidikan Ilmu Pengetahuan Alam", "Teknik Sipil"
        ];
    }
}
