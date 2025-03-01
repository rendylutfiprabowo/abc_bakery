<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'kotas';
    protected $fillable = ['provinsi_id', 'kota_id', 'kota', 'provinsi'];

    public function cabangsAsKota()
    {
        return $this->hasMany(Cabang::class, 'kota_id');
    }

    public function cabangsAsProvinsi()
    {
        return $this->hasMany(Cabang::class, 'provinsi_id');
    }

    public function cabangs()
    {
        return $this->hasMany(Cabang::class, 'kota_id');
    }
}
