<?php

namespace App\Repository\Eloquent;

use App\Models\Match_answer_language as ModelName;
use App\Repository\MatchAnswerLanguageRepositoryInterface;

class MatchAnswerLanguageRepository extends BaseRepository implements MatchAnswerLanguageRepositoryInterface
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

