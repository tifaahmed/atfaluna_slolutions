<?php

namespace App\Repository\Eloquent;

use App\Models\Mcq_answer as ModelName;
use App\Repository\McqAnswerRepositoryInterface;

class McqAnswerRepository extends BaseRepository implements McqAnswerRepositoryInterface
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

