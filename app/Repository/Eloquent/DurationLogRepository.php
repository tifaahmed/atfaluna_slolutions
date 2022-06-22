<?php

namespace App\Repository\Eloquent;

use App\Models\Duration_log as ModelName;
use App\Repository\DurationLogRepositoryInterface;

class DurationLogRepository extends BaseRepository implements DurationLogRepositoryInterface
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

