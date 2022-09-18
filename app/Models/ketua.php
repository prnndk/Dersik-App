<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ketua extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function dataketua(){
        return $this->hasMany(dataketua::class);
    }
}
