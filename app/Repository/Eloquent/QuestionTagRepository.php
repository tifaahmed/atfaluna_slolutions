<?php

namespace App\Repository\Eloquent;

use App\Models\QuestionTag as ModelName;
use App\Repository\QuestionTagRepositoryInterface;

class QuestionTagRepository extends BaseRepository implements QuestionTagRepositoryInterface
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

