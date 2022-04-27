<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\About_us\AboutUsApiRequest as modelInsertRequest;
use App\Http\Requests\Api\About_us\AboutUsUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\AboutUsCollection as ModelCollection;
use App\Http\Resources\Dashboard\AboutUsResource as ModelResource;

// lInterfaces
use App\Repository\AboutUsRepositoryInterface as ModelInterface;

class AboutUsController extends Controller
{
private $Repository;
public function __construct(ModelInterface $Repository)
{
    $this->ModelRepository = $Repository;
    $this->folder_name = 'About_us/'.Str::random(10).time();
}
public function all(){
    try {
        return new ModelCollection (  $this->ModelRepository->all() )  ;
    } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
            [$e->getMessage()  ] ,
            'Errors',
            Response::HTTP_NOT_FOUND
        );
    }
}

public function store(modelInsertRequest $request) {
    try {
        $all = [ ];
        $file_one = 'image_one';
        if ($request->hasFile($file_one)) {            
            $path = $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
            $all += array( $file_one => $path );            }
        $file_two = 'image_two';
        if ($request->hasFile($file_two)) {            
            $path= $this->HelperHandleFile($this->folder_name,$request->file($file_two),$file_two)  ;
            $all += array( $file_two => $path );
        }
        $file_three = 'image_three';
        if ($request->hasFile($file_three)) {            
            $path= $this->HelperHandleFile($this->folder_name,$request->file($file_three),$file_three)  ;
            $all += array( $file_three => $path );
        }
        $file_four = 'image_four';
        if ($request->hasFile($file_four)) {            
            $path= $this->HelperHandleFile($this->folder_name,$request->file($file_four),$file_four)  ;
            $all += array( $file_four => $path );
        }
        $model = new ModelResource( $this->ModelRepository->create( Request()->except($file_one,$file_two,$file_three,$file_four,)+$all ) );
        
        return $this -> MakeResponseSuccessful( 
            [ $model ],
            'Successful'               ,
            Response::HTTP_OK
        ) ;
    } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
            [$e->getMessage()  ] ,
            'Errors',
            Response::HTTP_BAD_REQUEST
        );
    }
}

public function collection(Request $request){
    try {
        return new ModelCollection (  $this->ModelRepository->collection( $request->PerPage ? $request->PerPage : 10) )  ;
    } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
            [$e->getMessage()  ] ,
            'Errors',
            Response::HTTP_NOT_FOUND
        );
    }
}


public function destroy($id) {
    try {
        return $this -> MakeResponseSuccessful( 
            [$this->ModelRepository->deleteById($id)] ,
            'Successful'               ,
            Response::HTTP_OK
        ) ;
    } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
            [ $e->getMessage()  ] ,
            'Errors',
            Response::HTTP_NOT_FOUND
        );
    }
}

public function premanently_delete($id) {
    try {
        $model = $this->ModelRepository->findTrashedById($id);
        $file_key_names =['image_one','image_two','image_three','image_four'];
        foreach ($file_key_names as $value) {
            //delete folder that has all this row files if exists
            $this->HelperDeleteDirectory($this->HelperGetDirectory($model->$value));
        }

        return $this -> MakeResponseSuccessful( 
            [$this->ModelRepository->PremanentlyDeleteById($id)] ,
            'Successful'               ,
            Response::HTTP_OK
        ) ;
    } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
            [ $e->getMessage()  ] ,
            'Errors',
            Response::HTTP_NOT_FOUND
        );
    }
}
public function show($id) {
    try {
        return $this -> MakeResponseSuccessful( 
            [new ModelResource ( $this->ModelRepository->findById($id) )  ],
            'Successful',
            Response::HTTP_OK
        ) ;
    } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
            [$e->getMessage()  ] ,
            'Errors',
            Response::HTTP_NOT_FOUND
        );
    }
}

public function update(modelUpdateRequest $request ,$id) {
    try {
        $all = [ ];
        $file_one = 'image_one';
        $old_model = new ModelResource( $this->ModelRepository->findById($id) );
        if ($request->hasFile($file_one)) {    
            // get the old directory
            $old_folder_location = $this->HelperGetDirectory($old_model->$file_one); 
            // delete the old file or image
            $this->HelperDelete($old_model->$file_one);   
            $location  = $old_folder_location ? $old_folder_location :   $this->folder_name;                 
            $path= $this->HelperHandleFile($location,$request->file($file_one),$file_one)  ;
            $all += array( $file_one => $path );

        }
        $file_two = 'image_two';
            if ($request->hasFile($file_two)) {  
                // get the old directory
                $old_folder_location = $this->HelperGetDirectory($old_model->$file_two); 
                // delete the old file or image
                $this->HelperDelete($old_model->$file_two);   
                $location  = $old_folder_location ? $old_folder_location :   $this->folder_name;                 
                $path= $this->HelperHandleFile($location,$request->file($file_two),$file_two)  ;
                $all += array( $file_two => $path );
            }
            $file_three = 'image_three';
        if ($request->hasFile($file_three)) {
            // get the old directory
            $old_folder_location = $this->HelperGetDirectory($old_model->$file_three); 
            // delete the old file or image
            $this->HelperDelete($old_model->$file_three);   
            $location  = $old_folder_location ? $old_folder_location :   $this->folder_name;                 
            $path= $this->HelperHandleFile($location,$request->file($file_three),$file_three)  ;
            $all += array( $file_three => $path );
        }
        $file_four = 'image_four';
        if ($request->hasFile($file_four)) { 
            // get the old directory
            $old_folder_location = $this->HelperGetDirectory($old_model->$file_four); 
            // delete the old file or image
            $this->HelperDelete($old_model->$file_four);   
            $location  = $old_folder_location ? $old_folder_location :   $this->folder_name;                 
            $path= $this->HelperHandleFile($location,$request->file($file_four),$file_four)  ;
            $all += array( $file_four => $path );
        }
            $this->ModelRepository->update( $id,Request()->except($file_one,$file_two,$file_three,$file_four,)+$all) ;
            $model = new ModelResource( $this->ModelRepository->findById($id) );


        return $this -> MakeResponseSuccessful( 
                [ $model],
                'Successful'               ,
                Response::HTTP_OK
        ) ;
    } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
            [$e->getMessage()  ] ,
            'Errors',
            Response::HTTP_NOT_FOUND
        );
    } 
}


// trash
    public function collection_trash(Request $request){
        try {
            return new ModelCollection (  $this->ModelRepository->collection_trash( $request->PerPage ? $request->PerPage : 10 ) ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    public function show_trash($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findTrashedById($id) )  ],
                'Successful',
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    public function restore($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [ $this->ModelRepository->restorById($id)  ],
                'Successful',
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
// trash

}