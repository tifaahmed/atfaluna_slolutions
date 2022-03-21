<?php

namespace App\Http\Controllers\ControllerTraits;

    use Illuminate\Http\JsonResponse ;
    // use Storage;
    // use Illuminate\Support\ZanySoft\Zip\Zip;
    // use Illuminate\Support\Facades\ZanySoft;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use Zip;

    // use ZanySoft\Zip\Zip;
    // use ZanySoft\Zip\Zip;
    trait FileTrait {

        // * @param  string $folder_name
        // * @param  file $file
        // * @param  string $key ex(image or url or image_one)
        // @return array  [ key => path value]
        public function HelperHandleFile($folder_name,$requested_file,$key)  
        {
            return $path = $this->HelperStorage($folder_name,$requested_file);
            // return array($key => $path);
        }


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
        // * @param  string $file_path
        // @return nothing
        public function HelperDelete($file_path)  
        {

            if ($file_path && Storage::disk('public')->exists($file_path)) {
                $extension = substr($file_path, strpos($file_path, ".") + 1);    //0 to 10 

                if ($extension == 'php' || $extension == 'html' ) {                     // delete folder
                    
                    $last_slash_position = strrpos($file_path, '/'); //10
                    $text = substr($file_path, 0, $last_slash_position); //0 to 10

                    Storage::disk('public')->deleteDirectory($text);
                return $extension.' deleted '; 
                } else{                                                                 // or delete file
                    Storage::disk('public')->delete($file_path);
                    return $extension.' deleted '; 
                }
            }
        }
        // * @param  collection $model
        // * @param  array of arraies  $file_names 
        // $file_names = [file_name_one,file_name_two ]
        // @return nothing
        public function HandleFileDelete($model,$file_key_names)  {
            foreach ($file_key_names  as  $file_key_name) {
                if (
                    isset($model->$file_key_name) 
                    && 
                    $model->$file_key_name            
                ) {   
                    $this->HelperDelete($model->$file_key_name);
                }
            }
        }

    }