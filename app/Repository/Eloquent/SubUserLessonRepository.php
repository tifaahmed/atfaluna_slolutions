<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_user_lesson as ModelName;
use App\Repository\SubUserLessonRepositoryInterface;

class SubUserLessonRepository extends BaseRepository implements SubUserLessonRepositoryInterface
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

