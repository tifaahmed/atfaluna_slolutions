<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\UserSubscriptionCollection as ModelCollection;
use App\Http\Resources\Mobile\UserSubscriptionResource as ModelResource;


// lInterfaces
use App\Repository\UserSubscriptionRepositoryInterface as ModelInterface;
use App\Repository\SubscriptionRepositoryInterface as ModelInterfaceSubscription;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserSubscriptionController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository, ModelInterfaceSubscription $RepositorySubscription)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositorySubscription = $RepositorySubscription;
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
    public function store(Request $request) {
        try {
            $modal =   Auth::user()->userSubscription()->first();
            if (!$modal) {
                $subscription =  $this->ModelRepositorySubscription->findById($request->subscription_id) ;            
                $end =   Carbon::now()->addMonths($subscription->month_number)->format('Y-m-d');
                $start =   Carbon::now()->format('Y-m-d');
                
                $all = [ ];
                $all += array( 'start' => $start ) ;
                $all += array( 'end' =>$end ) ;
                $all += array( 'child_number' =>$subscription->child_number ) ;
                $all += array( 'price' =>$subscription->price ) ;
                    
                $modal   =  new ModelResource( Auth::user()->userSubscription()->create( $all  ) );
            }
            

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
}