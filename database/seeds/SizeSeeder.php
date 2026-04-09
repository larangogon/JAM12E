<?php

use App\Entities\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = ['XS', 'S', 'M', 'L', 'XL'];

        foreach ($sizes as $size) {
            factory(Size::class)->create([
                'name' => $size,
            ]);
        }
    }
}
