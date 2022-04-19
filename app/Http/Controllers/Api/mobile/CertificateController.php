<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\CertificateCollection as ModelCollection;

use App\Http\Resources\Mobile\CertificateResource as ModelResource;


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
            return new ModelCollection (  $this->ModelRepository->collection( $request->PerPage ? $request->PerPage : 10)) ;

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
    // relation
    public function attach(MobileCertificateApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            // foreach ($request->certificate_id as $key => $value) {
                $model->subUserCertificate()->syncWithoutDetaching($request->certificate_ids);
            // } 
            return $this -> MakeResponseSuccessful( 
                ['Successful'],
                'Successful'               ,
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
    public function  detach(MobileCertificateApiRequest $request){
        try {
            $model = Auth::user()->sub_user()->find($request->sub_user_id); 
            $model->subUserCertificate()->detach($request->certificate_id);

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($request->certificate_id) )  ],
                'Successful'               ,
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
}