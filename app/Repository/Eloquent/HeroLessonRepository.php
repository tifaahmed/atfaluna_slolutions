<?php

namespace App\Repository\Eloquent;

use App\Models\Hero_lesson as ModelName;
use App\Repository\HeroLessonRepositoryInterface;

class HeroLessonRepository extends BaseRepository implements HeroLessonRepositoryInterface
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

