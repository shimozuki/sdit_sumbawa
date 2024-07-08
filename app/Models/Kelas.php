<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'kode_kelas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'wali_kelas',
    ];

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas', 'id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'kode_kelas');
    }
}

