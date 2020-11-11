<?php

namespace App\Exports;

use App\Entities\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersExport implements FromCollection, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
     * @return array
     * @var User $user
     */
    public function map($user): array
    {
        $roles = '';
        foreach ($user
                     ->roles()
                     ->pluck('name') as $rol) {
            $roles .= $rol . ',';
        }

        return [
            $user->id,
            $user->name,
            $user->phone,
            $user->cellphone,
            $user->document,
            $user->address,
            $user->email,
            $user->password,
            $user->active,
            $roles,
            Date::dateTimeToExcel($user->created_at),
        ];
    }
}
