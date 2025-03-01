<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kota_id', 'provinsi_id'];


    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Kota::class, 'provinsi_id');
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
