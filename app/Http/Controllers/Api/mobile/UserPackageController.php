<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\UserPackageCollection as ModelCollection;
use App\Http\Resources\Mobile\UserPackageResource as ModelResource;


// lInterfaces
use App\Repository\UserPackageRepositoryInterface as ModelInterface;
use App\Repository\PackageRepositoryInterface as ModelInterfacePackage;

use Illuminate\Support\Facades\Auth;


class UserPackageController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository, ModelInterfacePackage $RepositoryPackage)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositoryPackage = $RepositoryPackage;
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
    

    
    public function store(Request $request) {
        try {
            $package =  $this->ModelRepositoryPackage->findById($request->package_id) ;
            $package =  $package->makeHidden(['id','created_at','updated_at','deleted_at'])->toArray();
            $modal   =  new ModelResource( Auth::user()->userPackage()->create( $package  ) );

            return $this -> MakeResponseSuccessful( 
                [ $modal ],
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