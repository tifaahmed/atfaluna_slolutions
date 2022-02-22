<?php

namespace App\Repository\Eloquent;

use App\Models\True_false_question_language as ModelName;
use App\Repository\TrueFalseQuestionLanguageRepositoryInterface;

class TrueFalseQuestionLanguageRepository extends BaseRepository implements TrueFalseQuestionLanguageRepositoryInterface
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

