<?php

namespace App\Repository\Eloquent;

use App\Models\Mcq_question as ModelName;
use App\Repository\McqQuestionRepositoryInterface;

class McqQuestionRepository extends BaseRepository implements McqQuestionRepositoryInterface
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

