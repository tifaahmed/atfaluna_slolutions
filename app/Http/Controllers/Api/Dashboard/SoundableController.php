<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\Soundable\SoundableApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\SoundableCollection as ModelCollection;
use App\Http\Resources\Dashboard\SoundableResource as ModelResource;

// lInterfaces
use App\Repository\SoundableRepositoryInterface as ModelInterface;

class SoundableController extends Controller
{
private $Repository;
public function __construct(ModelInterface $Repository)
{
    $this->ModelRepository = $Repository;
    $this->folder_name = 'soundable/'.Str::random(10).time();
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
        $file = 'record';
        if ($request->hasFile($file)) {            
            $path = $this->HelperHandleFile($this->folder_name,$request->file($file),$file)  ;
            $all += array( $file => $path );            }        
        $model = new ModelResource( $this->ModelRepository->create( Request()->except($file)+$all ) );
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
        $file_key_names =['record'];
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

public function update(modelInsertRequest $request ,$id) {
    try {
        $all = [ ];
        $file = 'record';
        $old_model = new ModelResource( $this->ModelRepository->findById($id) );
        if ($request->hasFile($file)) {    
            // get the old directory
            $old_folder_location = $this->HelperGetDirectory($old_model->$file); 
            // delete the old file or image
            $this->HelperDelete($old_model->$file);   
            $location  = $old_folder_location ? $old_folder_location :   $this->folder_name;                 
            $path= $this->HelperHandleFile($location,$request->file($file),$file)  ;
            $all += array( $file => $path );

        }
            $this->ModelRepository->update( $id,Request()->except($file,)+$all) ;
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