<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_user_achievement as ModelName;
use App\Repository\SubUserAchievementRepositoryInterface;

class SubUserAchievementRepository extends BaseRepository implements SubUserAchievementRepositoryInterface
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

