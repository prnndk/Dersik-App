<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function kateginfo()
    {
        return $this->belongsTo(kateginfo::class,'kategori_informasi');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'oleh');
    }
    public function angkat()
    {
        return $this->belongsTo(Angkatan::class,'angkatan');
    }
}
