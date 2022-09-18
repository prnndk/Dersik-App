<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempatstatus extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function detail()
    {
        return $this->belongsTo(detailstatus::class,'id_detail');
    }
}
