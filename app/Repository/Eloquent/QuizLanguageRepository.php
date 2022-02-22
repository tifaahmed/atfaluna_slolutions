<?php

namespace App\Repository\Eloquent;

use App\Models\Quiz_language as ModelName;
use App\Repository\QuizLanguageRepositoryInterface;

class QuizLanguageRepository extends BaseRepository implements QuizLanguageRepositoryInterface
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

