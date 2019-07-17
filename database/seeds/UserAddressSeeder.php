<?php

use Illuminate\Database\Seeder;
use App\Models\UserAddress;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserAddress::class , 10)->create(['user_id'=>1]);
        //
    }
}
