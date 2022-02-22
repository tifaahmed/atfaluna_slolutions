<?php

namespace App\Repository\Eloquent;

use App\Models\Package as ModelName;
use App\Repository\PackageRepositoryInterface;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
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

