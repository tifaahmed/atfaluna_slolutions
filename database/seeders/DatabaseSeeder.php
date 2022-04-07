<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run( ) {
        $this -> call ( basics::class );

        $this -> call ( RolesAndPermissionsSeeder::class );
        $this -> call ( CountrySeeder::class );
        $this -> call ( UserSeeder::class );
        $this -> call ( LanguageSeeder::class );
        $this -> call ( AgeGroupSeeder::class );
    }
}
