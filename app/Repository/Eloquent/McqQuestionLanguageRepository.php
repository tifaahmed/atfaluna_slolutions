<?php

namespace App\Repository\Eloquent;

use App\Models\Mcq_question_language as ModelName;
use App\Repository\McqQuestionLanguageRepositoryInterface;

class McqQuestionLanguageRepository extends BaseRepository implements McqQuestionLanguageRepositoryInterface
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

