<?php

namespace App\Repository\Eloquent;

use App\Models\SubUserSkin as ModelName;
use App\Repository\SubUserSkinRepositoryInterface;

class SubUserSkinRepository extends BaseRepository implements SubUserSkinRepositoryInterface
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

