<?php

use Illuminate\Database\Seeder;
use App\Models\LockerManagement\Locker;
use Illuminate\Support\Str;

class LockerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Locker::class,1)->create();

        // 'qrcode',
        // 'per_hour_price',
        // 'is_active',
        // 'is_using',

        $faker = Faker\Factory::create();



        for ($i = 1; $i <= 8; $i++) {
//            $pattern = $faker->randomElement(['1', '2']);
            Locker::create([
                'qrcode'            =>  'LOCKER-' . Str::random(12),
//                'per_hour_price'    =>  $faker->randomFloat($nbMaxDecimals = 2, $min = 0.2, $max = 3),
                'per_hour_price'    =>  1,
                'is_active'         =>  $i==4?2:1,
                'is_using'          =>  1,
            ]);
        }
    }
}
