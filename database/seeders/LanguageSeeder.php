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
        Language::create( [ 'id' => '1','name' => 'en'   ,'full_name' => 'english' ] )  ;
        Language::create( [ 'id' => '2','name' => 'ar'   ,'full_name' => 'العربية' ] )  ;

    }
}
