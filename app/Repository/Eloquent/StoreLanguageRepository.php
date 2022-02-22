<?php

namespace App\Repository\Eloquent;

use App\Models\Store_language as ModelName;
use App\Repository\StoreLanguageRepositoryInterface;

class StoreLanguageRepository extends BaseRepository implements StoreLanguageRepositoryInterface
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

