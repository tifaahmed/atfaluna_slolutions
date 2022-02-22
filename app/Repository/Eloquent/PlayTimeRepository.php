<?php

namespace App\Repository\Eloquent;

use App\Models\Play_time as ModelName;
use App\Repository\PlayTimeRepositoryInterface;

class PlayTimeRepository extends BaseRepository implements PlayTimeRepositoryInterface
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

