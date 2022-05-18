<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Requests
use App\Http\Requests\Api\Subscription\SubscriptionApiRequest as modelInsertRequest;


// Resources
use App\Http\Resources\Dashboard\Collections\SubscriptionCollection as ModelCollection;
use App\Http\Resources\Dashboard\SubscriptionResource as ModelResource;


// lInterfaces
use App\Repository\SubscriptionRepositoryInterface as ModelInterface;
use App\Repository\SubscriptionLanguageRepositoryInterface as ModelInterfaceLanguage; //Languages
use Carbon\Carbon;
use Auth;
class SubscriptionController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository,ModelInterfaceLanguage $RepositoryLanguage)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositoryLanguage = $RepositoryLanguage;
        $this->related_language = 'subscription_id';
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
            return new ModelCollection (  $this->ModelRepository->collection( $request->PerPage ? $request->PerPage : 10) )  ;

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
    public function attach(Request $request){
        try {

            $user   =   Auth::user();
            $model  =   $this->ModelRepository->findById($request->subscription_id) ;           
            $start  =   Carbon::now();
            $end    =   Carbon::now()->addMonths(3) ;
            
            $user->userSubscription()->delete();
            $user->userSubscription()->create([
                'start' => $start ,
                'end' => $end ,
                'child_number' => $model->child_number ,
                'price' => $model->price ,
            ]);

            return $this -> MakeResponseSuccessful( 
                [$user->userSubscription()->first()],
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