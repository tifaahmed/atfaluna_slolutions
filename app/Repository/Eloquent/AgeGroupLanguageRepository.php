<?php

namespace App\Repository\Eloquent;

use App\Models\Age_group_language as ModelName;
use App\Repository\AgeGroupLanguageRepositoryInterface;

class AgeGroupLanguageRepository extends BaseRepository implements AgeGroupLanguageRepositoryInterface
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

