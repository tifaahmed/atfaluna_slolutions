<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create( [ 'name' => 'en'   ,'full_name' => 'english' ] )  ;
        Language::create( [ 'name' => 'ar'   ,'full_name' => 'العربية' ] )  ;

    }
}
