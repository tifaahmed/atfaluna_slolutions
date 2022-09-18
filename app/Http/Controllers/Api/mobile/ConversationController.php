<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

// Requests
use App\Http\Requests\Api\Conversation\ConversationApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Mobile\Collections\ConversationCollection as ModelCollection;
use App\Http\Resources\Mobile\ConversationResource as ModelResource;

// lInterfaces
use App\Repository\ConversationRepositoryInterface as ModelInterface;
use App\Repository\GroupChatRepositoryInterface as GroupChatInterface;

class ConversationController extends Controller
{
    private $Repository;
    private $GroupChatRepository;

    public function __construct(ModelInterface $Repository,GroupChatInterface $GroupChatRepository)
    {
        $this->ModelRepository = $Repository;
        $this->GroupChatRepository = $GroupChatRepository;
    }
    public function all(Request $request){
        try {
            return $model = $this->ModelRepository->filterAll( 
                $request->sub_user_id,
                $request->has_message,
                $request->type,
            );
            return new ModelCollection ( $model  )  ;
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
                $request->has_message,
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
    public function store(modelInsertRequest $request) {
        try {

            if ($request->type == 'single'  ) {
                 $checkExist =  $this->ModelRepository->checkExist($request->sub_user_id,$request->recevier_ids,$request->type);
                    $model = $checkExist->count() ? $checkExist : null ;
                    if ( !$checkExist->count() ) {
                        $model =  $this->ModelRepository->create( Request()->all() )  ;
                        $model -> group_chats()->create(['recevier_id'=>$request->recevier_ids[0]]);
                    }
                    

            }else{
                $model = $this->ModelRepository->create( Request()->all() );
                foreach ($request->recevier_ids as $key => $value) {
                    $model -> group_chats()->create(['recevier_id'=>$request->recevier_ids[$key]]);
                }
            }

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


    
    public function destroy($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [$this->ModelRepository->deleteById($id)] ,
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [ $e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }



    public function show($id) {
        try {
            $model = $this->ModelRepository->findById($id) ; 

            // $model->massages()->where('')

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $model)  ],
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
    
}