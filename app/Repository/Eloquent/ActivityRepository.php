<?php

namespace App\Repository\Eloquent;

use App\Models\Activity as ModelName;
use App\Repository\ActivityRepositoryInterface;


class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface
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


