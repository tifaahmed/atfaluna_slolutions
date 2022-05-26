<?php

namespace App\Repository;

interface SubscriptionRepositoryInterface extends EloquentRepositoryInterface{
	public function attachSubscription($subscription_id,$sub_user_id)  ;


}
