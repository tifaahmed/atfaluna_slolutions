<?php

namespace App\Repository\Eloquent;

use App\Models\Basic as ModelName;
use App\Repository\BasicRepositoryInterface;

class BasicRepository extends BaseRepository implements BasicRepositoryInterface
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

