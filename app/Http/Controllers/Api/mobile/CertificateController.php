<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\CertificateController\CertificateCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\CertificateController\CertificateResource as ModelResource;


// lInterfaces
use App\Repository\CertificateRepositoryInterface as ModelInterface;

use App\Http\Requests\Api\Certificate\MobileCertificateApiRequest;

use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll(
                $request->sub_user_id,
                $request->age_group_id,
                $request->type
            );
            return new ModelCollection (  $model )  ;
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
            $model = $this->ModelRepository->filterPaginate(
                $request->sub_user_id,
                $request->age_group_id,
                $request->type,
                $request->PerPage ? $request->PerPage : 10
            );
            return new ModelCollection ( $model )  ;

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
}