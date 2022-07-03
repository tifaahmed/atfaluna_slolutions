<?php

namespace App\Repository\Eloquent;

use App\Models\HumanPart as ModelName;
use App\Repository\HumanPartRepositoryInterface;

class HumanPartRepository extends BaseRepository implements HumanPartRepositoryInterface
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