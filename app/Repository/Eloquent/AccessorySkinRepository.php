<?php

namespace App\Repository\Eloquent;

use App\Models\AccessorySkin as ModelName;
use App\Repository\AccessorySkinRepositoryInterface;


class AccessorySkinRepository extends BaseRepository implements AccessorySkinRepositoryInterface
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

