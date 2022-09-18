<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataketua extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function kelases()
    {
        return $this->belongsTo(kelas::class,'kelas');
    }
    public function ketua()
    {
       return $this->belongsTo(ketua::class);
    }
    public function kota()
    {
        return $this->belongsTo(Regency::class,'tempatlahir');
    }
}
