<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Age_group;
use App\Models\Certificate;

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
            $age_group= Age_group::create(['id' => '1', ]);
            $age_group->age_group_languages()->create( [
                'name' => 'تمهيدي اولى',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'kg1',
                'language' => 'en',
            ]);
            $age_group->age()->create( [ 'age' => '3' ]); 
            $certificate = Certificate::find(3);
            $certificate->certificatable()->associate($age_group)->save();
            
        // 2
            $age_group= Age_group::create(['id' => '2', ]);
            $age_group->age_group_languages()->create( [
                'name' => 'تمهيدي ثانى',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'kg2',
                'language' => 'en',
            ]);
            $age_group->age()->create( [ 'age' => '4' ]); 
            $certificate = Certificate::find(4);
            $certificate->certificatable()->associate($age_group)->save();
        // 3
            $age_group= Age_group::create(['id' => '3', ]);
            $age_group->age_group_languages()->create( [
                'name' => 'اولى ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 1',
                'language' => 'en',
            ]);
            $age_group->age()->create( [ 'age' => '5' ]); 
            $certificate = Certificate::find(9);
            $certificate->certificatable()->associate($age_group)->save();
        // 4
            $age_group= Age_group::create(['id' => '4', ]);
            $age_group->age_group_languages()->create( [
                'name' => 'ثانية ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 2',
                'language' => 'en',
            ]);
            $age_group->age()->create( ['age' => '6' ]); 
            $certificate = Certificate::find(10);
            $certificate->certificatable()->associate($age_group)->save();  
        // 5
            $age_group= Age_group::create(['id' => '5', ]);
            $age_group->age_group_languages()->create( [
                'name' => 'ثالثة ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 3',
                'language' => 'en',
            ]);
            $age_group->age()->create( ['age' => '7' ]); 
            $certificate = Certificate::find(11);
            $certificate->certificatable()->associate($age_group)->save();    
        // 6
            $age_group= Age_group::create(['id' => '6', ]);
            $age_group->age_group_languages()->create( [
                'name' => 'رابعة ابتدائي',
                'language' => 'ar',
            ]);
            $age_group->age_group_languages()->create( [
                'name' => 'year 4',
                'language' => 'en',
            ]);
            $age_group->age()->create( ['age' => '8' ]);
            $certificate = Certificate::find(12);
            $certificate->certificatable()->associate($age_group)->save();  
    }

}
