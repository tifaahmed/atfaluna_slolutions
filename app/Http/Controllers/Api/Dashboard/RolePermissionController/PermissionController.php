<?php

namespace App\Http\Controllers\Api\Dashboard\RolePermissionController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\RolePerssionRequest\PermissionApiRequest ;
use Illuminate\Http\Response ;

// use App\Models\Permission;

use App\Http\Resources\Collections\RolePerssionCollection\PermissionCollection;
use App\Http\Resources\RolePerssionResource\PermissionResource;

use App\Repository\RolePermissionInterface\PermissionRepositoryInterface;

use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    private $PermissionRepository;
    


    public function __construct(PermissionRepositoryInterface $PermissionRepository)
    {
        $this->PermissionRepository = $PermissionRepository;
    }

    public function store( PermissionApiRequest $request ) {
        $permission = Permission::create(['name' => $request->name]);
        // $permission = $this->PermissionRepository->create( Request()->all() );
        return $this -> MakeResponseSuccessful( 
            ['PermissionModel'  => $permission ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function destroy(Request $request) {
        return $this -> MakeResponseSuccessful( 
            [ 'PermissionModel'  => $this->PermissionRepository->deleteById($request->id) ],
            'Successful',
            Response::HTTP_OK
         ) ;
    }
    public function collection(Request $request){
        return new PermissionCollection(  $this->PermissionRepository->collection($request->PerPage) ) ;
    }
}
