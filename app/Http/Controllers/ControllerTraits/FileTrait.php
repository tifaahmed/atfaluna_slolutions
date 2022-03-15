<?php

namespace App\Http\Controllers\ControllerTraits;

use Illuminate\Http\JsonResponse ;
use Storage;
use ZanySoft\Zip\Zip;
use Str;
trait FileTrait {
	// * @param  string $folder_name
	// * @param  file $file
    // @return url of the file
    public function HelperStorage($folder_name , $file  ) : string
    {
        if ($file->extension() == 'zip' ) {
            $random_string = Str::random(10);
            $location = $folder_name.'/'.$random_string.time();
            $path = Storage::disk('public')->put($location,$file);
            $zip = Zip::open( public_path('storage').'/'.$path );
            $zip->extract(public_path('storage').'/'.$location);

            if( file_exists( public_path('storage').'/'.$location.'/index.php') ){
                return $location.'/index.php';
            }else if( file_exists( public_path('storage').'/'.$location.'/index.html') ){
                return $location.'/index.html';
            }else{
                return $location;
            }

           
        }else{
            return $path = Storage::disk('public')->put($folder_name,$file);
        }
    }
	// * @param  string $url
	// @return nothing
    public function HelperDelete($url)  
    {
        if (Storage::disk('public')->exists($url)) {
            Storage::disk('public')->delete($url);
        }
    }

	// * @param  string $folder_name
	// * @param  file $file
	// * @param  string $file_name
	// @return array  [file_name => path]
    public function HelperHandleFile($folder_name,$requested_file,$file_name)  
    {
        $path = $this->HelperStorage($folder_name,$requested_file);
        return array($file_name => $path);
    }


}