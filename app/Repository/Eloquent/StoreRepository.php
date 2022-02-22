<?php

namespace App\Repository\Eloquent;

use App\Models\Store as ModelName;
use App\Repository\StoreRepositoryInterface;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
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

