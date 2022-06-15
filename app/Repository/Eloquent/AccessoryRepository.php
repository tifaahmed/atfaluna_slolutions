<?php

namespace App\Repository\Eloquent;

use App\Models\Accessory as ModelName;
use App\Repository\AccessoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AccessoryRepository extends BaseRepository implements AccessoryRepositoryInterface
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
