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
        // try {


            switch ($request->massagable_type) {
                case 'hero':
                    $class = Hero::class;
                    $image = Hero::find($request->massagable_id)->hero_languages()->Localization()->first()->image;
                    break;
                case 'image':
                    $class = Massage_image::class;
                    $image = Massage_image::find($request->massagable_id)->image ;
                    break;
                case 'avatar':
                    $class = Avatar::class;
                    $image = Avatar::find($request->massagable_id)->skins()->Original()->first()->image ;

                    break;
                default:
                $class = '';
                $image = '';
            }

            // notifications
            // return $this ->TraitChatNotification($image,$request->text,$request->conversation_id,$request->sub_user_id);
            $all = [];
            $all += Request()->all()   ;
            $all['massagable_type'] =   $class ;
            $model =  $this->ModelRepository->create( $all ) ;

            $model->subUserMessageRead()->syncWithoutDetaching([$request->sub_user_id => [ 'read' =>  1 ]]);
            $group_chats = $model->conversation->group_chats;
            foreach ($group_chats as $key => $value) {
                $model->subUserMessageRead()->syncWithoutDetaching([$value->recevier_id => [ 'read' =>  0 ]]);
            }

            return $this -> MakeResponseSuccessful( 
                [ new ModelResource( $model ) ],
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        // } catch (\Exception $e) {
        //     return $this -> MakeResponseErrors(  
        //         [$e->getMessage()  ] ,
        //         'Errors',
        //         Response::HTTP_BAD_REQUEST
        //     );
        // }
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