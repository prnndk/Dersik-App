<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class domainlist extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function Angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'angkatan_id');
    }
    public function regisEmail()
    {
        return $this->hasMany(regisEmail::class);
    }
}
