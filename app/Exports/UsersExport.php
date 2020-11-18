<?php

namespace App\Exports;

use App\Entities\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
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
        foreach ($user->roles()->pluck('name') as $rol) {
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

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Phone',
            'Cellphone',
            'Document',
            'Address',
            'Email',
            'Password',
            'Active',
            'Roles',
        ];
    }
}
