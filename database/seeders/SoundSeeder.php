<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sound;
use File;

class SoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folder =  storage_path('app/public/sounds');
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
        
        File::copy(public_path('images/records/arabic.MP3'),$folder.'\arabic.MP3');
        File::copy(public_path('images/records/arabic_en.Ogg'),$folder.'\arabic_en.Ogg');
        File::copy(public_path('images/records/math.MP3'),$folder.'\math.MP3');
        File::copy(public_path('images/records/math_en.Ogg'),$folder.'\math_en.Ogg');
        File::copy(public_path('images/records/games.MP3'),$folder.'\games.MP3');
        File::copy(public_path('images/records/games_en.Ogg'),$folder.'\games_en.Ogg');
        File::copy(public_path('images/records/science.MP3'),$folder.'\science.MP3');
        File::copy(public_path('images/records/science_en.Ogg'),$folder.'\science_en.Ogg');
        File::copy(public_path('images/records/stories_en.Ogg'),$folder.'\stories_en.Ogg');

        // 1
        $sounds= Sound::create([
            'id' => '1',
            'name' => 'علوم',
            'language' => 'ar',
            'record' => 'sounds/science.MP3',
        ]); 
        // 2
        $sounds= Sound::create([
            'id' => '2',
            'name' => 'Science',
            'language' => 'en',
            'record' => 'sounds/science_en.Ogg',
        ]);  
        // 3
        $sounds= Sound::create([
            'id' => '3',
            'name' => 'حساب',
            'language' => 'ar',
            'record' => 'sounds/math.MP3',
        ]);
        // 4
        $sounds= Sound::create([
            'id' => '4',
            'name' => 'Math',
            'language' => 'en',
            'record' => 'sounds/math_en.Ogg',
        ]); 
        // 5
        $sounds= Sound::create([
            'id' => '5',
            'name' => ' عربي',
            'language' => 'ar',
            'record' => 'sounds/arabic.MP3',
        ]); 
        // 6
        $sounds= Sound::create([
            'id' => '6',
            'name' => 'Arabic',
            'language' => 'en',
            'record' => 'sounds/arabic_en.Ogg',
        ]); 
        // 7
        $sounds= Sound::create([
            'id' => '7',
            'name' => ' العاب',
            'language' => 'ar',
            'record' => 'sounds/games.MP3',
        ]);
        // 8
        $sounds= Sound::create([
            'id' => '8',
            'name' => 'Games',
            'language' => 'en',
            'record' => 'sounds/games_en.Ogg',
        ]);
        // 9
        $sounds= Sound::create([
            'id' => '9',
            'name' => 'Stories',
            'language' => 'en',
            'record' =>'sounds/stories_en.Ogg',
        ]);  
        // // 10
        // $sounds= Sound::create([
        //     'id' => '5',
        //     'name' => ' قصص',
        //     'language' => 'ar',
        //     'record' => 'sounds/stories.MP3',
        // ]);      
    }
}
