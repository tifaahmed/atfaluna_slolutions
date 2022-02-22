<?php

namespace App\Repository\Eloquent;

use App\Models\Lesson_type as ModelName;
use App\Repository\LessonTypeRepositoryInterface;

class LessonTypeRepository extends BaseRepository implements LessonTypeRepositoryInterface
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

