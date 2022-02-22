<?php

namespace App\Repository\Eloquent;

use App\Models\Age as ModelName;
use App\Repository\AgeRepositoryInterface;

class AgeRepository extends BaseRepository implements AgeRepositoryInterface
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

