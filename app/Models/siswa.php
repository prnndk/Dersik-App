<?php

namespace App\Models;

use App\Models\kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siswa extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function kls()
    {
        return $this->belongsTo(kelas::class, 'kelas');
    }
    public function sttus()
    {
        return $this->belongsTo(status::class, 'status');
    }
    public function kab()
    {
        return $this->belongsTo(Regency::class, 'domisili');
    }
    public function angkat()
    {
        return $this->belongsTo(Angkatan::class, 'angkatan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
