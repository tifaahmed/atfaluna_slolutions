<?php

namespace App\Repository\Eloquent;

use App\Models\Duration_time as ModelName;
use App\Repository\DurationTimeRepositoryInterface;

class DurationTimeRepository extends BaseRepository implements DurationTimeRepositoryInterface
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

