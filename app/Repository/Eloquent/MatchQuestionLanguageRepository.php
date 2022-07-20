<?php

namespace App\Repository\Eloquent;

use App\Models\Match_question_language as ModelName;
use App\Repository\MatchQuestionLanguageRepositoryInterface;

class MatchQuestionLanguageRepository extends BaseRepository implements MatchQuestionLanguageRepositoryInterface
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

