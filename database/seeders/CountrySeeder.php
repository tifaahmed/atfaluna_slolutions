<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Str;
use File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folder =  storage_path('app/public/country');
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
        
        File::copy(public_path('images/eg.png'),$folder.'\eg.png');

        $admin= Country::create( [
            'name' => 'egypt',
            'image' => 'country/eg.png',
            'code' => '02',
            'language' => 'ar'

        ]);
    }
}
