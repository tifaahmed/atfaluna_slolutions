<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use App\Models\Friend;
// Requests
use App\Http\Requests\Api\Friend\FriendApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Friend\FriendUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\FriendController\FriendCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\FriendController\FriendResource as ModelResource;

// lInterfaces
use App\Repository\FriendRepositoryInterface as ModelInterface;

class FriendController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll(
                $request->sub_user_id
            );
            return new ModelCollection ( $model )  ;
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
            $model = $this->ModelRepository->firstOrCreate( Request()->all() );
            return $this -> MakeResponseSuccessful( 
                [ new ModelResource( $model ) ],
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
            return $model = $this->ModelRepository->filterPaginate( 
                $request->sub_user_id ,
                $request->PerPage ? $request->PerPage : 10 ,
            );
            return new ModelCollection ( $model )  ;
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
}