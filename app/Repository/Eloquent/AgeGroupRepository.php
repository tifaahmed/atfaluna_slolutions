<?php

namespace App\Repository\Eloquent;

use App\Models\Age_group as ModelName;
use App\Repository\AgeGroupRepositoryInterface;

class AgeGroupRepository extends BaseRepository implements AgeGroupRepositoryInterface
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

