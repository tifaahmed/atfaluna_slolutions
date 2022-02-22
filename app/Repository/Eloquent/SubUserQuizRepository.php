<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_user_quiz as ModelName;
use App\Repository\SubUserQuizRepositoryInterface;

class SubUserQuizRepository extends BaseRepository implements SubUserQuizRepositoryInterface
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

