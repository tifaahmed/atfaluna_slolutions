<?php

namespace App\Repository\Eloquent;

use App\Models\AccessoryPart as ModelName;
use App\Repository\AccessoryPartRepositoryInterface;

class AccessoryPartRepository extends BaseRepository implements AccessoryPartRepositoryInterface
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