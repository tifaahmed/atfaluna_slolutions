<?php

namespace App\Repository\Eloquent;

use App\Models\Hero_language as ModelName;
use App\Repository\HeroLanguageRepositoryInterface;

class HeroLanguageRepository extends BaseRepository implements HeroLanguageRepositoryInterface
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

