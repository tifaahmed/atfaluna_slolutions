<?php

namespace App\Http\Controllers\ControllerTraits;

use Illuminate\Http\JsonResponse ;
use Storage;

trait FileTrait {
	// * @param  string $folder_name
	// * @param  file $file
    // @return url of the file
    public function HelperStorage($folder_name , $file  ) : string
    {
        return Storage::disk('public')->put($folder_name,$file);
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