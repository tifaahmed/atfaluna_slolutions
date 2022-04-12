<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\AboutUsResource as ModelResource;


// lInterfaces
use App\Repository\AboutUsRepositoryInterface as ModelInterface;


class AboutUsController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }

    public function all(Request $request){
        try {
            return new ModelResource (  $this->ModelRepository->filterFirst($request->language) );
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    

}