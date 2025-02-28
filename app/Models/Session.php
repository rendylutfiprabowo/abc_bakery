<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = ['user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];

    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
