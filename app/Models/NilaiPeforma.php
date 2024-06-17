<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPeforma extends Model
{
    protected $table = "nilai_peforma";
    protected $primaryKey = ["nisn_siswa", "kode_peforma"];
    protected $fillable = ['nisn_siswa','kode_peforma','nilai', 'predikat', 'ket'];
    public $incrementing = false;
    use HasFactory;

    public function peforma()
    {
        return $this->belongsTo(peforma::class, 'kode_peforma','kode_peforma');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn_siswa','nisn');
    }
}
