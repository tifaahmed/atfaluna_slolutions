<?php

namespace App\Repository\Eloquent;

use App\Models\Package_language as ModelName;
use App\Repository\PackageLanguageRepositoryInterface;

class PackageLanguageRepository extends BaseRepository implements PackageLanguageRepositoryInterface
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

