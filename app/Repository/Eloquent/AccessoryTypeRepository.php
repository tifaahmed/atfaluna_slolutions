<?php

namespace App\Repository\Eloquent;

use App\Models\AccessoryType as ModelName;
use App\Repository\AccessoryTypeRepositoryInterface;

class AccessoryTypeRepository extends BaseRepository implements AccessoryTypeRepositoryInterface
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