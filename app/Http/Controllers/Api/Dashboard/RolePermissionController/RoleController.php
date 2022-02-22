<?php

namespace App\Http\Controllers\Api\Dashboard\RolePermissionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\RolePerssionRequest\RoleApiRequest ;
use Illuminate\Http\Response ;

use App\Http\Resources\Dashboard\Collections\RolePerssionCollection\RoleCollection;
use App\Http\Resources\Dashboard\RolePerssionResource\RoleResource;

use App\Repository\RolePermissionInterface\RoleRepositoryInterface as ModelInterface;


class RoleController extends Controller
{
    private $RoleRepository;
    
    public function __construct(ModelInterface $RoleRepository)
    {
        $this->RoleRepository = $RoleRepository;
    }


    public function store( RoleApiRequest $request ) {
        return $this -> MakeResponseSuccessful( 
            ['Model'  => $this->RoleRepository->create( Request()->all() ) ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function show($id) {
        return $this -> MakeResponseSuccessful( 
            ['UserModel'  => new RoleResource ( $this->RoleRepository->findById($id) )  ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function destroy(Request $request) {
        return $this -> MakeResponseSuccessful( 
            [ 'Model'  => $this->RoleRepository->deleteById($request->id) ],
            'Successful',
            Response::HTTP_OK
         ) ;
    }
    public function collection(Request $request){
        return RoleResource::collection(  $this->RoleRepository->collection($request->PerPage ? $request->PerPage : 10) ) ;
    }

}
