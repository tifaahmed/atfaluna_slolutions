<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

// Request
use App\Http\Requests\Api\SubUser\MobileStoreSubUserApiRequest ;
// use App\Http\Requests\Api\User\MobileDeleteSubUserApiRequest ;

// Resources
use App\Http\Resources\Mobile\Collections\SubUserCollection as ModelCollection;
use App\Http\Resources\Mobile\SubUserResource as ModelResource;

use Illuminate\Support\Facades\Auth;
// lInterfaces
use App\Repository\SubUserRepositoryInterface as ModelInterface;


class SubUserController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
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
    public function collection(Request $request){
        // return $request->language;
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
    
    public function store(MobileStoreSubUserApiRequest $request){
        try {
            $sub_user = Auth::user()->sub_user()->create( $request->all() );
            // attach one age group and only one can be active
            $this->ModelRepository->attachAgeGroupByAge($sub_user->age,$sub_user->id) ;

            return $this->show($sub_user->id);

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function update(MobileStoreSubUserApiRequest $request ,$id) {
        try {
            $this->ModelRepository->update( $id,Request()->all()) ;
            return $this->show($id);

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        } 
    }
    
    public function destroy($id){
        try {
            return $this -> MakeResponseSuccessful( 
                [ Auth::user()->sub_user()->find($id)->delete() ],
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
}