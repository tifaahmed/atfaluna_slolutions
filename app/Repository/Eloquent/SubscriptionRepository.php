<?php

namespace App\Repository\Eloquent;

use App\Models\Subscription as ModelName;
use App\Repository\SubscriptionRepositoryInterface;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Response ;

class SubscriptionRepository extends BaseRepository implements SubscriptionRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(ModelName $model)
	{
		$this->model =  $model;
	}


	public function attachSubscription($subscription_id,$sub_user_id) 
	{
		$model  =   $this->findById($subscription_id) ;  
		
		$user 	= Auth::user();   
		$user_created_at = new Carbon ($user->created_at);   
		$end_date =  $model->price <= 0 ? $user_created_at->addMonths($model->month_number) :  Carbon::now()->addMonths($model->month_number) ;
		
		$sub_user   =   $user->sub_user()->find($sub_user_id);
		$sub_user_subscription = $sub_user->SubUserSubscriptions()->first();


		// ex/ old regestred user
		// if its free subscription && user acount creation date is   older than the subscription end date will be 
		if ($model->price <= 0  && Carbon::now() >= $user_created_at ->addMonths($model->month_number)   ) {
			return abort( Response::HTTP_BAD_REQUEST , 'trial period has ended');
		}  


		// ex/ olready subscriped
		// if the child has subscription
		if ($sub_user_subscription ){

			// if the child in the subscription period
			if ( Carbon::now() <= $sub_user_subscription->end ) 
			{
				return abort( Response::HTTP_BAD_REQUEST , 'child have subscribed before');
			}
			// if the child after the subscription period
			if ( Carbon::now() > $sub_user_subscription->end ) 
			{
				$sub_user->SubUserSubscriptions()->delete();
				return $this->createSubscription($model,$end_date,$sub_user);
			}
		}

		// ex/ after create new child
		else{
			return $this->createSubscription($model,$end_date,$sub_user);
		}   
	}

	public function createSubscription($model,$end_date,$sub_user) {
		return  $sub_user->SubUserSubscriptions()->create([
			'start' => Carbon::now()  ,
			'end' 	=> $end_date ,
			'price' => $model->price ,
		]);
	}

	
}

