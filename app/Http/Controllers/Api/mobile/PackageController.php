<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\Package\MobilePackageApiRequest;
// Resources
use App\Http\Resources\Mobile\Collections\PackageCollection as ModelCollection;
use App\Http\Resources\Mobile\PackageResource as ModelResource;

// lInterfaces
use App\Repository\PackageRepositoryInterface as ModelInterface;


class PackageController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository )
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
    
   // relation
   public function attach(MobilePackageApiRequest $request){
    try {
        $package = $this->ModelRepository->findById($request->package_id);
        $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);

        $sub_user->update(['points'=> $sub_user->points + $package->points]) ;
        return $this -> MakeResponseSuccessful( 
            ['Successful'],
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
}