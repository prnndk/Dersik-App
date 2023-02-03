<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;


class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        return new User([
        'id'=>$row[0],
        'uuid'=>Str::uuid(),
        'name'=>$row[1],
        'username'=>$row[2],
        'email'=>$row[3],
        'email_verified_at'=>$row[4],
        'kelas_id'=>$row[5],
        'tempatlahir'=>$row[6],
        'dob'=>$row[7],
        'role'=>$row[8],
        'password'=>Hash::make($row[9]),
        ]);
    }
}
