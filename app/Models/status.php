<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function detailstatus()
    {
        return $this->hasMany(detailstatus::class);
    }
    public function siswa()
    {
        return $this->hasMany(siswa::class);
    }
}
