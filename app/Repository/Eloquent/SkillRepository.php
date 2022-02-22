<?php

namespace App\Repository\Eloquent;

use App\Models\Skill as ModelName;
use App\Repository\SkillRepositoryInterface;

class SkillRepository extends BaseRepository implements SkillRepositoryInterface
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

