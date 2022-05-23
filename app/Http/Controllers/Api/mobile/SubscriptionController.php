<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Requests
use App\Http\Requests\Api\Subscription\SubscriptionApiRequest as modelInsertRequest;


// Resources
use App\Http\Resources\Mobile\Collections\SubscriptionCollection as ModelCollection;
use App\Http\Resources\Mobile\SubscriptionResource as ModelResource;


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

            $model  =   $this->ModelRepository->findById($request->subscription_id) ;  

            $auth_created_at = new Carbon (Auth::user()->created_at);   
            if ($model->price <= 0  && Carbon::now() >= $auth_created_at ->addMonths($model->month_number)   ) {
                return $this -> MakeResponseSuccessful( 
                    ['trial period has ended'],
                    'Errors'               ,
                    Response::HTTP_BAD_REQUEST
                ) ;
            }  

            $sub_user   =   Auth::user()->sub_user()->find($request->sub_user_id);
            $sub_user_subscription = $sub_user->SubUserSubscriptions()->first();
            if ($sub_user_subscription &&  Carbon::now() > $sub_user_subscription->start &&  Carbon::now() < $sub_user_subscription->end) {
                return $this -> MakeResponseSuccessful( 
                    ['child have subscribed before'],
                    'Errors'               ,
                    Response::HTTP_BAD_REQUEST
                ) ;
            }else{
                $sub_user_subscription = $sub_user->SubUserSubscriptions()->delete();
                $start  =   Carbon::now();
                $end    =   Carbon::now()->addMonths($model->month_number) ;
                $sub_user_subscription = $sub_user->SubUserSubscriptions()->create([
                    'start' => $start ,
                    'end' => $end ,
                    'price' => $model->price ,
                ]);
            }    



            return $this -> MakeResponseSuccessful( 
                [$sub_user_subscription],
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