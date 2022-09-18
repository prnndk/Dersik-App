<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemilih extends Model
{
    use HasFactory;
    protected $fillable=['id','user_id','token','status_pilih','vote_id'];
    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }
    public function vote()
    {
        return $this->belongsTo(vote::class,'vote_id');
    }
}
