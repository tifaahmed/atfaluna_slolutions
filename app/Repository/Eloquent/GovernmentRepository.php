<?php

namespace App\Repository\Eloquent;

use App\Models\Government as ModelName;
use App\Repository\GovernmentRepositoryInterface;

class GovernmentRepository extends BaseRepository implements GovernmentRepositoryInterface
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

