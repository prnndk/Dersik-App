<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class korwil extends Model
{
    use HasFactory;

    protected $guarded=['id'];
public function kota()
{
    return $this->belongsTo(Regency::class,'kota_id');
}

}
