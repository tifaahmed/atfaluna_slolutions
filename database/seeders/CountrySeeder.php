<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin= Country::create( [
            'name' => 'egypt',
            'image' => 'country/eg.png',
            'code' => '02',
        ]);
    }
}
