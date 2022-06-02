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
        $folder =  storage_path('app/public/sounds/');
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
        
        // File::makeDirectory(public_path('images/records/arabic.MP3'));
        
        File::copy(public_path('images/records/arabic.mp3'),$folder.'arabic.mp3');
        File::copy(public_path('images/records/arabic_en.ogg'),$folder.'arabic_en.ogg');
        File::copy(public_path('images/records/math.mp3'),$folder.'math.mp3');
        File::copy(public_path('images/records/math_en.ogg'),$folder.'math_en.ogg');
        File::copy(public_path('images/records/games.mp3'),$folder.'games.mp3');
        File::copy(public_path('images/records/games_en.ogg'),$folder.'games_en.ogg');
        File::copy(public_path('images/records/science.mp3'),$folder.'science.mp3');
        File::copy(public_path('images/records/science_en.ogg'),$folder.'science_en.ogg');
        File::copy(public_path('images/records/stories_en.ogg'),$folder.'stories_en.ogg');
        
        Sound::truncate(); 
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
