<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // <--- BARIS INI DIHAPUS

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable; // <--- HasApiTokens DIHAPUS
    use HasFactory, Notifiable; // <--- HANYA MENGGUNAKAN INI

    /**
     * The attributes that are mass assignable.
     * Termasuk kolom-kolom baru untuk pasien dan dokter.
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'alamat',
        'no_hp',
        'no_ktp',
        'no_rm', // Kolom untuk Pasien
        'id_poli', // Kolom untuk Dokter
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    // --- Relasi Model ---

    /**
     * User (Dokter) memiliki satu Poli.
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * User (Dokter) memiliki banyak JadwalPeriksa.
     */
    public function jadwalPeriksa()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
}