<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function RegisProm()
    {
        return $this->hasMany(RegisProm::class);
    }
    public function User()
    {
        return $this->hasMany(User::class);
    }
    public function dataketua()
    {
        return $this->hasMany(dataketua::class);
    }
    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatan');
    }
    public function siswa()
    {
        return $this->hasMany(siswa::class);
    }
}
