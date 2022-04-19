<?php

namespace App\Repository\Eloquent;

use App\Models\Achievement as ModelName;
use App\Repository\AchievementRepositoryInterface;

class AchievementRepository extends BaseRepository implements AchievementRepositoryInterface
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

