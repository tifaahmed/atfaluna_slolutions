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


    public function store(Request $request) {
        try {
            switch ($request->massagable_type) {
                case 'hero':
                    $class = Hero::class;
                    break;
                case 'image':
                    $class = Massage_image::class;
                    break;
                case 'avatar':
                    $class = Avatar::class;
                    break;
                default:
                    $class = '';
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
    public function all(Request $request){
        try {
            return new ModelCollection (  
                $this->ModelRepository->filterAll($request->conversation_id) 
            )  ;
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
            return new ModelCollection (  
                $this->ModelRepository->filterPaginate( 
                    $request->conversation_id,
                    $request->PerPage ? $request->PerPage : 10) 
            )  ;

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    } 
}