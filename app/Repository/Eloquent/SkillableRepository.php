<?php

namespace App\Repository\Eloquent;

use App\Models\Skillable as ModelName;
use App\Repository\SkillableRepositoryInterface;

class SkillableRepository extends BaseRepository implements SkillableRepositoryInterface
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

