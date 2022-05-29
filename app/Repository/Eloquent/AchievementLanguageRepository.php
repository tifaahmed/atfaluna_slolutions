<?php

namespace App\Repository\Eloquent;

use App\Models\Achievement_language as ModelName;
use App\Repository\AchievementLanguageRepositoryInterface;

class AchievementLanguageRepository extends BaseRepository implements AchievementLanguageRepositoryInterface
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

