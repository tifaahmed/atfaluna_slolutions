<?php

namespace App\Repository\Eloquent;

use App\Models\SkinLanguage as ModelName;
use App\Repository\SkinLanguageRepositoryInterface;

class SkinLanguageRepository extends BaseRepository implements SkinLanguageRepositoryInterface
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

