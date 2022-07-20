<?php

namespace App\Repository\Eloquent;

use App\Models\Match_answer as ModelName;
use App\Repository\MatchAnswerRepositoryInterface;

class MatchAnswerRepository extends BaseRepository implements MatchAnswerRepositoryInterface
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

