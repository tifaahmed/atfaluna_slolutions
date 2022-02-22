<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run( ) {
        // $this -> call ( RolesAndPermissionsSeeder::class );
        // $this -> call ( CountrySeeder::class );
        // $this -> call ( UserSeeder::class );
        $this -> call ( LanguageSeeder::class );
        $this -> call ( basics::class );

    }
}
