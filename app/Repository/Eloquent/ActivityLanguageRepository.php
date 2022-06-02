<?php

namespace App\Repository\Eloquent;

use App\Models\Activity_language as ModelName;
use App\Repository\ActivityLanguageRepositoryInterface;

class ActivityLanguageRepository extends BaseRepository implements ActivityLanguageRepositoryInterface
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

