<?php

namespace App\Repository\Eloquent;

use App\Models\User_package as ModelName;
use App\Repository\UserPackageRepositoryInterface;

class UserPackageRepository extends BaseRepository implements UserPackageRepositoryInterface
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

