<?php

namespace App\Repository\Eloquent;

use App\Models\Accessory_language as ModelName;
use App\Repository\AccessoryLanguageRepositoryInterface;

class AccessoryLanguageRepository extends BaseRepository implements AccessoryLanguageRepositoryInterface
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

