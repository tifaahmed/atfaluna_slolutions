<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use File;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 6; $i++) { 

        $folder =  storage_path('app/public/quiz');
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
        File::copy(public_path('images/quiz1.png'),$folder.'\quiz1.png');
        File::copy(public_path('images/quiz2.png'),$folder.'\quiz2.png');

        $quiz= Quiz::create( [
            'id' => '1',
            'points' => '300',
            'minimum_requirements' => '200',
        ]);          
        $quiz->quiz_languages()->create( [
            'name' => 'امتحان  ',
            'image_one' => 'quiz/quiz1.jpg',
            'image_two' => 'quiz/quiz2.jpg',
            'language' => 'ar',
        ]);
        $quiz->quiz_languages()->create( [
            'name' => 'quiz ',
            'image_one' => 'quiz/quiz1.jpg',
            'image_two' => 'quiz/quiz2.jpg',
            'language' => 'en',
        ]);
    }

    }
}
