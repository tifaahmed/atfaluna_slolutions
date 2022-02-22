<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_user as ModelName;
use App\Repository\SubUserRepositoryInterface;

class SubUserRepository extends BaseRepository implements SubUserRepositoryInterface
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

