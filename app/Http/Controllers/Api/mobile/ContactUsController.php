<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\Contact_us\ContactUsApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Contact_us\ContactUsUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Mobile\Collections\ContactUsCollection as ModelCollection;
use App\Http\Resources\Mobile\ContactUsResource as ModelResource;

// lInterfaces
use App\Repository\ContactUsRepositoryInterface as ModelInterface;

class ContactUsController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }

    public function store(modelInsertRequest $request) {
        try {
            $modal = new ModelResource( $this->ModelRepository->create( Request()->all() ));
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