<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Lesson_type;

class LessonType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson_type::create( [ 'name' => 'game' ] )  ;
        Lesson_type::create( [ 'name' => 'video'] )  ;

    }
}
