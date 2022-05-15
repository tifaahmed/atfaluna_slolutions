<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\Sounds\SoundsApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Sounds\SoundsUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Mobile\Collections\SoundsCollection as ModelCollection;
use App\Http\Resources\Mobile\SoundsResource as ModelResource;

// lInterfaces
use App\Repository\SoundsRepositoryInterface as ModelInterface;

class SoundsController extends Controller
{
private $Repository;
public function __construct(ModelInterface $Repository)
{
    $this->ModelRepository = $Repository;
    $this->folder_name = 'sounds/'.Str::random(10).time();
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