<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

use App\Models\Hero;
use App\Models\Avatar;
use App\Models\Massage_image;

// Requests
use App\Http\Requests\Api\Massage\MassageApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Mobile\Collections\MassageCollection as ModelCollection;
use App\Http\Resources\Mobile\MassageResource as ModelResource;

// lInterfaces
use App\Repository\MassageRepositoryInterface as ModelInterface;

class MassageController extends Controller
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

    public function store(modelInsertRequest $request) {
        try {

            if ($request->massagable_type == 'hero') {
                $class = Hero::class;
            }else if($request->massagable_type == 'image'){
                $class = Massage_image::class;
            }else if($request->massagable_type == 'avatar'){
                $class = Avatar::class;
            }
            $all = [];
            $all += Request()->all()   ;
            $all['massagable_type'] =   $class ;
            $model = new ModelResource( $this->ModelRepository->create( $all ) );

            return $this -> MakeResponseSuccessful( 
                [ $model ],
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