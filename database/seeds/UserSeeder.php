<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = new User();

        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->address = 'Cra 79-94-51';
        $user->email_verified_at = now();
        $user->cellphone = '3002133378';
        $user->phone = '4895013';
        $user->password = bcrypt(123);
        $user->document = '1214716610';

        $user->save();
        $user->assignRole('Administrator');

        factory(User::class, 100)->create();
    }
}
