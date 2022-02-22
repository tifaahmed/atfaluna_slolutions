<?php

namespace App\Repository\Eloquent;

use App\Models\City as ModelName;
use App\Repository\CityRepositoryInterface;

class CityRepository extends BaseRepository implements CityRepositoryInterface
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

