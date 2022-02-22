<?php

namespace App\Repository\Eloquent;

use App\Models\True_false_question as ModelName;
use App\Repository\TrueFalseQuestionRepositoryInterface;

class TrueFalseQuestionRepository extends BaseRepository implements TrueFalseQuestionRepositoryInterface
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

