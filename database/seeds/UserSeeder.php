<?php

use App\Entities\Cart;
use App\Entities\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user =  new User();

        $this->user->name = 'Admin';
        $this->user->email = 'admin@example.com';
        $this->user->address = 'Cra 79-94-51';
        $this->user->email_verified_at = now();
        $this->user->cellphone = '3002133378';
        $this->user->phone = '4895013';
        $this->user->password = bcrypt(123);
        $this->user->document = '1214716610';

        $this->user->save();

        $user = User::find(1);
        $user->assignRole('Administrator');

        factory(User::class, 10)->create();
    }
}
