<?php

namespace App\Http\Controllers\Api\Dashboard\RolePermissionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\RolePermissionRequest\RoleApiRequest ;
use Illuminate\Http\Response ;

use App\Http\Resources\Dashboard\Collections\RolePermissionCollection\RoleCollection;
use App\Http\Resources\Dashboard\RolePermissionResource\RoleResource;

use App\Repository\RolePermissionInterface\RoleRepositoryInterface as ModelInterface;


class RoleController extends Controller
{
    private $RoleRepository;
    
    public function __construct(ModelInterface $RoleRepository)
    {
        $this->RoleRepository = $RoleRepository;
    }

    public function all(){
        try {
            return  new RoleCollection (  $this->RoleRepository->all() )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }

        
    }
    public function store( RoleApiRequest $request ) {
        return $this -> MakeResponseSuccessful( 
            [ $this->RoleRepository->create( Request()->all() ) ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function show($id) {
        return $this -> MakeResponseSuccessful( 
            [ new RoleResource ( $this->RoleRepository->findById($id) )  ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }

    public function destroy(Request $request) {
        return $this -> MakeResponseSuccessful( 
            [ $this->RoleRepository->deleteById($request->id) ],
            'Successful',
            Response::HTTP_OK
            ) ;
    }
    public function collection(Request $request){
        try {
            return new RoleResource (  $this->RoleRepository->collection( $request->PerPage ? $request->PerPage : 10) )  ;

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
