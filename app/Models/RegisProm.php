<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisProm extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'kelas_id',
        'user_id',
        'nama',
        'email',
        'kesediaan',
        'kedinasan',
        'tanggal',
        'qr_code',
        'statusbayar',
        'no_hp',
    ];
    protected $with = [
        'kelas',
        'User',
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
