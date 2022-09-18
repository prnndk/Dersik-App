<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vote extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function angkatan()
    {
       return $this->belongsTo(angkatan::class,'angkatan_id');
    }
    public function pemilih()
    {
        return $this->hasMany(pemilih::class);
    }
}
