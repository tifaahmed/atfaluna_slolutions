<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Age_group;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
            $age_group= Age_group::create();
            $age_group->age_group_languages()->create( [
                'name' => 'تمهيدي اولى',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'kg1',
                'language' => 'en',
            ]);
            $age_group->age()->create( [ 'age' => '3' ]); 
        // 2
            $age_group= Age_group::create();
            $age_group->age_group_languages()->create( [
                'name' => 'تمهيدي ثانى',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'kg2',
                'language' => 'en',
            ]);
            $age_group->age()->create( [ 'age' => '4' ]); 
        // 3
            $age_group= Age_group::create();
            $age_group->age_group_languages()->create( [
                'name' => 'اولى ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 1',
                'language' => 'en',
            ]);
            $age_group->age()->create( [ 'age' => '5' ]); 
        // 4
            $age_group= Age_group::create();
            $age_group->age_group_languages()->create( [
                'name' => 'ثانية ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 2',
                'language' => 'en',
            ]);
            $age_group->age()->create( ['age' => '6' ]);   
        // 5
            $age_group= Age_group::create();
            $age_group->age_group_languages()->create( [
                'name' => 'ثالثة ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 3',
                'language' => 'en',
            ]);
            $age_group->age()->create( ['age' => '7' ]);     
        // 6
            $age_group= Age_group::create();
            $age_group->age_group_languages()->create( [
                'name' => 'رابعة ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 4',
                'language' => 'en',
            ]);
            $age_group->age()->create( ['age' => '8' ]);         
    }

}
