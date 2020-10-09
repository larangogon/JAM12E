<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'name'      => $row[1],
            'phone'     => $row[2],
            'cellphone' => $row[3],
            'document'  => $row[4],
            'address'   => $row[5],
            'email'     => $row[6],
            'password'  => Hash::make($row[7]),
            'active'    => $row[8],
        ]);
    }
}
