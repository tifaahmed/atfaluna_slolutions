<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Basic;
use Illuminate\Support\Str;
use File;

class basics extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folder =  storage_path('app/public/basics/');
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }

        File::copy(public_path('images/logo.png'),$folder.'logo.png');

        Basic::truncate(); 

        Basic::create( [
            'id' => '1',
            'item' => 'basics/logo.png',
            'info' => 'logo',
        ]);
        Basic::create( [
            'id' => '2',
            'item' => 'atfaluna',
            'info' => 'site name en',
        ]);
        Basic::create( [
            'id' => '3',
            'item' => 'اطفانا',
            'info' => 'site name ar',
        ]);
        Basic::create( [
            'id' => '4',
            'item' => '1000',
            'info' => 'one = points',
        ]);
    }
}
