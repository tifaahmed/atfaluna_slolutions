<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Quiz_type;

class QuizType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz_type::create( [ 'id' => '1','name' => 'assignment'] )  ;
        Quiz_type::create( [ 'id' => '2','name' => 'quiz'] )  ;
    }
}
