<?php

namespace App\Repository\Eloquent;

use App\Models\Massage as ModelName;
use App\Repository\MassageRepositoryInterface;

class MassageRepository extends BaseRepository implements MassageRepositoryInterface
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


