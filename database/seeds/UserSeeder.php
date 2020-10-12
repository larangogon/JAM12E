<?php


use App\Cart;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create();

        $roles = Role::all();

        User::inRandomOrder()->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        $user = User::find(1);
        $user->assignRole('Administrator');

        $this->cart =  new Cart();

        $this->cart->user_id = $user->id;
        $this->cart->save();
    }
}
