<?php

namespace App\Imports;

use App\Entities\Role;
use App\Entities\User;
use App\Rules\RoleRule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements WithValidation, ToModel, WithBatchInserts
{
    use Importable;
    use SkipsErrors;
    use SkipsFailures;

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|void|null
     */
    public function model(array $row)
    {
        $user = User::updateOrCreate(
            ['id' => $row[0]
            ],
            [
                'name'      => $row[1],
                'phone'     => $row[2],
                'cellphone' => $row[3],
                'document'  => $row[4],
                'address'   => $row[5],
                'email'     => $row[6],
                'password'  => Hash::make($row[7]),
                'active'    => $row[8],
            ]
        );

        $user->roles()->detach(null);

        $roles = explode(',', $row[9]);

        $count = count($roles);

        foreach ($roles as $key => $role) {
            if ($key == $count - 1) {
                break;
            }
            $roleBd = Role::where('name', $role)->first();
            $user->roles()->attach(array($roleBd->id));
        }
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3' => ['required', 'numeric'],
            '*.4' => ['required', 'numeric'],
            '*.5' => 'required',
            '*.6' => ['required'],
            '*.7' => 'required',
            '*.8' => 'required',
            '*.9' => [new RoleRule()],
        ];
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
}
