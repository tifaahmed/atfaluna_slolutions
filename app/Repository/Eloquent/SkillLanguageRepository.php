<?php

namespace App\Repository\Eloquent;

use App\Models\Skill_language as ModelName;
use App\Repository\SkillLanguageRepositoryInterface;

class SkillLanguageRepository extends BaseRepository implements SkillLanguageRepositoryInterface
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

