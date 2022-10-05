<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use File;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Certificate::query()->forceDelete();


        for ($i=1; $i <= 6; $i++) { 
            $folder =  storage_path('app/public/certificates/');
            if (!file_exists($folder)) {
                File::makeDirectory($folder);
            }

            File::copy(public_path('images/age1.jpg'),$folder.'age1.jpg');
            File::copy(public_path('images/age2.jpg'),$folder.'age2.jpg');
            File::copy(public_path('images/age3.png'),$folder.'age3.png');
            
            $certificate= Certificate::create( [
                'id' => $i,
                'image_one' => 'certificates/age1.jpg',
                'image_two' => 'certificates/age2.jpg',
                'image_three' => 'certificates/age3.png',
                'min_point' => '300',
                'max_point' => '800',
            ]);
            $certificate->certificate_languages()->create( [
                'title_one' => ' شهادة',
                'title_two' => 'عربي',
                'description' => 'للحصول على الشهادة يجب ان تحصل على % 50',
                'language' => 'ar',
            ]);
            $certificate->certificate_languages()->create( [
                'title_one' => ' شهادة',
                'title_two' => 'عربي',
                'description' => 'للحصول على الشهادة يجب ان تحصل على % 50',
                'language' => 'en',
            ]);
        }

    }

}
