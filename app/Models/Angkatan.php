<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function domain()
    {
        return $this->hasMany(domainlist::class);
    }
    public function kelas()
    {
        return $this->hasMany(kelas::class);
    }
    public function info()
    {
        return $this->hasMany(Informasi::class);
    }
}
