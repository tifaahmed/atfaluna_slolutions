<?php

namespace App\Repository\Eloquent;

use App\Models\Subscription_language as ModelName;
use App\Repository\SubscriptionLanguageRepositoryInterface;

class SubscriptionLanguageRepository extends BaseRepository implements SubscriptionLanguageRepositoryInterface
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

