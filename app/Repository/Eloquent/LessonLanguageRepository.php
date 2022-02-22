<?php

namespace App\Repository\Eloquent;

use App\Models\Lesson_language as ModelName;
use App\Repository\LessonLanguageRepositoryInterface;

class LessonLanguageRepository extends BaseRepository implements LessonLanguageRepositoryInterface
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

