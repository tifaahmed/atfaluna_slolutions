<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

//AgeGroupController
// Requests
use App\Http\Requests\Api\Basic\BasicApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Basic\BasicUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\BasicCollection as ModelCollection;
use App\Http\Resources\Dashboard\BasicResource as ModelResource;

// lInterfaces
use App\Repository\BasicRepositoryInterface as ModelInterface;

class BasicController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
        $this->folder_name = 'basics';

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
    

    public function update(modelUpdateRequest $request ,$id) {
        // try {
            $old_model = new ModelResource( $this->ModelRepository->findById($id) );


            if ( $request->hasFile('item') ) { 
                $all = [ ];
                // get the old directory
                if ( $old_model->item ) {
                    // delete the old file or image
                    $this->HelperDelete($old_model->item);  
                }
                $path = $this->HelperHandleFile($this->folder_name,$request->file('item'),'item')  ;
                $all += array( 'item' => $path );
                            // update
                $this->ModelRepository->update( $id,Request()->except('item')+$all) ;
            }else{
                $this->ModelRepository->update( $id,Request()->all()) ;
            }
            $modal = new ModelResource($this->ModelRepository->findById($id)); 


            return $this -> MakeResponseSuccessful( 
                    [ $modal],
                    'Successful'               ,
                    Response::HTTP_OK
            ) ;
        // } catch (\Exception $e) {
        //     return $this -> MakeResponseErrors(  
        //         [$e->getMessage()  ] ,
        //         'Errors',
        //         Response::HTTP_NOT_FOUND
        //     );
        // } 
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


}
