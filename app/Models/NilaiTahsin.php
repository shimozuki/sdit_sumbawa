<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTahsin extends Model
{
    protected $table = "nilai_tahsin";
    protected $primaryKey = ["nisn_siswa", "kode_tahsin"];
    protected $fillable = ['nisn_siswa','kode_tahsin','nilai', 'predikat', 'ket'];
    public $incrementing = false;
    use HasFactory;

    public function tahsin()
    {
        return $this->belongsTo(Tahsin::class, 'kode_tahsin','kode_tahsin');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn_siswa','nisn');
    }
}
