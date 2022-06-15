<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;
use File;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folder =  storage_path('app/public/achievement/');
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
        // Achievement::query()->forceDelete();

        File::copy(public_path('images/achievement/achievementlv1.png'),$folder.'achievementlv1.png');
        File::copy(public_path('images/achievement/lv1.png'),$folder.'lv1.png');
        File::copy(public_path('images/achievement/achievementlv2.png'),$folder.'achievementlv2.png');
        File::copy(public_path('images/achievement/lv2.png'),$folder.'lv2.png');
        File::copy(public_path('images/achievement/achievementlv3.png'),$folder.'achievementlv3.png');
        File::copy(public_path('images/achievement/lv3.png'),$folder.'lv3.png');
        File::copy(public_path('images/achievement/achievementlv4.png'),$folder.'achievementlv4.png');
        File::copy(public_path('images/achievement/lv3.png'),$folder.'lv4.png');
        File::copy(public_path('images/achievement/achievementlv5.png'),$folder.'achievementlv5.png');
        File::copy(public_path('images/achievement/lv3.png'),$folder.'lv5.png');

        $name_1_ar = ' الألعاب ' ;
        $name_1_en = 'Games' ;
        
        $name_2_ar = ' الفيديوهات ' ;
        $name_2_en = 'Videos' ;
        
        $name_3_ar = ' الأنشطة ' ;
        $name_3_en = 'Activities' ;
        
        $name_4_ar = ' الشخصيات ' ;
        $name_4_en = 'Avatars' ;
        
        $name_5_ar = '  الاسيمنتات ' ;
        $name_5_en = 'assignmentes' ;
        
        $name_6_ar = '  الكويزات ' ;
        $name_6_en = 'Quizzes' ;
        
        $name_7_ar = ' الاكسسوارات ' ;
        $name_7_en = 'Accessories' ;

        for ($i=1; $i <= 7; $i++) { 
            $achievement= Achievement::create( [
                'id' => $i,
            ]);
            $achievement->achievement_languages()->create( [
                'name' =>  
                    ($i == 1) ? 
                        (
                            $name_1_ar 
                        )
                    :
                        (
                            ($i == 2) ? 
                            (
                                $name_2_ar 
                            )
                            :
                                (
                                    ($i == 3) ? 
                                    (
                                        $name_3_ar 
                                    ) 
                                    :
                                        (
                                            ($i == 4) ? 
                                            (
                                                $name_4_ar 
                                            ) 
                                            :
                                                (
                                                    ($i == 5) ? 
                                                    (
                                                        $name_5_ar 
                                                    ) 
                                                    :
                                                        (
                                                            ($i == 6) ? 
                                                            (
                                                                $name_6_ar 
                                                            ) 
                                                            :
                                                                (
                                                                    ($i == 7) ? 
                                                                    (
                                                                        $name_7_ar 
                                                                    ) 
                                                                    :
                                                                        null
                                                                )))))),
                'description' => 'العدد الذي تم الوصول اليه فى هذة المرحلة',
                'language' => 'ar',
            ]);
            $achievement->achievement_languages()->create( [
                'name' =>  
                ($i == 1) ? 
                    (
                        $name_1_en
                    )
                :
                    (
                        ($i == 2) ? 
                        (
                            $name_2_en 
                        )
                        :
                            (
                                ($i == 3) ? 
                                (
                                    $name_3_en 
                                ) 
                                :
                                    (
                                        ($i == 4) ? 
                                        (
                                            $name_4_en
                                        ) 
                                        :
                                            (
                                                ($i == 5) ? 
                                                (
                                                    $name_5_en 
                                                ) 
                                                :
                                                    (
                                                        ($i == 6) ? 
                                                        (
                                                            $name_6_en 
                                                        ) 
                                                        :
                                                            (
                                                                ($i == 7) ? 
                                                                (
                                                                    $name_7_en 
                                                                ) 
                                                                :
                                                                    null
                                                            )))))),        
                'description' => 'The number reached at this stage',
                'language' => 'en',
            ]);

            $achievement->achivementImages()->create([
                'points' => '100',
                'image_one' => 'achievement/achievementlv1.png',
                'image_two'  => 'achievement/lv1.png',
            ]);            
            $achievement->achivementImages()->create([
                'points' => '200',
                'image_one' => 'achievement/achievementlv2.png',
                'image_two'  => 'achievement/lv2.png',
            ]);  
            $achievement->achivementImages()->create([
                'points' => '300',
                'image_one' => 'achievement/achievementlv3.png',
                'image_two'  => 'achievement/lv3.png',
            ]);  
            $achievement->achivementImages()->create([
                'points' => '400',
                'image_one' => 'achievement/achievementlv4.png',
                'image_two'  => 'achievement/lv4.png',
            ]);  
            $achievement->achivementImages()->create([
                'points' => '500',
                'image_one' => 'achievement/achievementlv5.png',
                'image_two'  => 'achievement/lv5.png',
            ]); 
        }    
    }
}

