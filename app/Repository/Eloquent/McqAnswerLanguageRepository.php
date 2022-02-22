<?php

namespace App\Repository\Eloquent;

use App\Models\Mcq_answer_language as ModelName;
use App\Repository\McqAnswerLanguageRepositoryInterface;

class McqAnswerLanguageRepository extends BaseRepository implements McqAnswerLanguageRepositoryInterface
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

