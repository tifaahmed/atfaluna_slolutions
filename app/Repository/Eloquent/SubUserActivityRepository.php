<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_user_activity as ModelName;
use App\Repository\SubUserActivityRepositoryInterface;

class SubUserActivityRepository extends BaseRepository implements SubUserActivityRepositoryInterface
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

