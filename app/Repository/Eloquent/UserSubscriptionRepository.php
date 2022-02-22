<?php

namespace App\Repository\Eloquent;

use App\Models\User_subscription as ModelName;
use App\Repository\UserSubscriptionRepositoryInterface;

class UserSubscriptionRepository extends BaseRepository implements UserSubscriptionRepositoryInterface
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




	
}

