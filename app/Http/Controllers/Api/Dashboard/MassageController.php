<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

// Requests

// Resources
use App\Http\Resources\Dashboard\Collections\MassageCollection as ModelCollection;
use App\Http\Resources\Dashboard\MassageResource as ModelResource;

// lInterfaces
use App\Repository\MassageRepositoryInterface as ModelInterface;

class MassageController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
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
}