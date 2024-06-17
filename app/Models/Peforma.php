<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peforma extends Model
{
    protected $table = "peforma";
    protected $primaryKey = "kode_peforma";
    protected $fillable = ['kode_peforma', 'nama'];
    public $incrementing = false;
    use HasFactory;

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
