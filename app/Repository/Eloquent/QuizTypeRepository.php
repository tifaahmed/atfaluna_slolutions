<?php

namespace App\Repository\Eloquent;

use App\Models\Quiz_type as ModelName;
use App\Repository\QuizTypeRepositoryInterface;

class QuizTypeRepository extends BaseRepository implements QuizTypeRepositoryInterface
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

