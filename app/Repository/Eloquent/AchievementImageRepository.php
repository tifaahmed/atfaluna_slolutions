<?php

namespace App\Repository\Eloquent;

use App\Models\AchievementImage as ModelName;
use App\Repository\AchievementImageRepositoryInterface;

class AchievementImageRepository extends BaseRepository implements AchievementImageRepositoryInterface
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

