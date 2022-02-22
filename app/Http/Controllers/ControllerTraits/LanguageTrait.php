<?php

namespace App\Http\Controllers\ControllerTraits;

use Illuminate\Http\JsonResponse ;

trait LanguageTrait {

    // * @param  string $disk
	// * @param  string $path
	// * @param  file $file
    // @return path of the file

    public function handleLanguageData($language,$coulmn_name,$id){
        return array_merge($language, [$coulmn_name => $id] ) ;
    }
	// * @param  string $disk
	// * @param  string $path
	// * @param  file $file
    	// * @param  string $url

	// @return nothing

}