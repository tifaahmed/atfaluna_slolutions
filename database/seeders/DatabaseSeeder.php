<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run( ) {
        $this -> call ( basics::class );

        $this -> call ( QuizType::class );
        $this -> call ( LessonType::class );
        $this -> call ( RolesAndPermissionsSeeder::class );
        $this -> call ( CountrySeeder::class );
        $this -> call ( UserSeeder::class );
        $this -> call ( LanguageSeeder::class );
        // $this -> call ( QuizSeeder::class );
        $this -> call ( CertificateSeeder::class );
        $this -> call ( AgeGroupSeeder::class );

    }
}
