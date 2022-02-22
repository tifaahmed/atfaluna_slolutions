<?php

namespace App\Repository\Eloquent;

use App\Models\Subject_language as ModelName;
use App\Repository\SubjectLanguageRepositoryInterface;

class SubjectLanguageRepository extends BaseRepository implements SubjectLanguageRepositoryInterface
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

