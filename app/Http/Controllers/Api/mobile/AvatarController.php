<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


use App\Http\Requests\Api\Avatar\MobileAvatarApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\AvatarCollection as ModelCollection;
use App\Http\Resources\Mobile\AvatarResource as ModelResource;


// lInterfaces
use App\Repository\AvatarRepositoryInterface as ModelInterface;

use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll($request->Gender);
            return new ModelCollection (  $model  );

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    public function collection(Request $request){
        try {
            $model =  $this->ModelRepository->filterPaginate($request->Gender,$request->PerPage ? $request->PerPage : 10) ;             
            return new ModelCollection ( $model )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
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
}