<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahsin extends Model
{
    protected $table = "tahsin";
    protected $primaryKey = "kode_tahsin";
    protected $fillable = ['kode_tahsin', 'nama'];
    public $incrementing = false;
    use HasFactory;

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
