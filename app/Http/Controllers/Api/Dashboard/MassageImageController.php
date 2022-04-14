<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\MassageImage\MassageImageApiRequest as modelInsertRequest;
use App\Http\Requests\Api\MassageImage\MassageImageUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\MassageImageCollection as ModelCollection;
use App\Http\Resources\Dashboard\MassageImageResource as ModelResource;

// lInterfaces
use App\Repository\MassageImageRepositoryInterface as ModelInterface;

class MassageImageController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
        $this->folder_name = 'MassageImage/'.Str::random(10).time();;

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
            $file_one = 'image';
            if ($request->hasFile($file_one)) {            
                $path = $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
                $all += array( $file_one => $path );
            }

            $model = new ModelResource( $this->ModelRepository->create( Request()->except($file_one)+$all ) );


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
            $old_model = new ModelResource( $this->ModelRepository->findById($id) );

            // files
            $all = [ ];
            $file_one = 'image';
            if ( $request->hasFile($file_one) ) { 
                // get the old directory
                if ( $old_model->$file_one ) {
                    $old_folder_location = $this->HelperGetDirectory($old_model->$file_one); 
                    // delete the old file or image
                    $this->HelperDelete($old_model->$file_one);  
                }
                $folder_location = $old_folder_location ? $old_folder_location : $this->folder_name;
                
                $path = $this->HelperHandleFile($folder_location,$request->file($file_one),$file_one)  ;
                $all += array( $file_one => $path );
            }
            $this->ModelRepository->update( $id,Request()->except($file_one)+$all) ;
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

        public function premanently_delete($id) {
            try {
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