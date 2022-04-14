<?php

namespace App\Repository\Eloquent;

use App\Models\Massage_image as ModelName;
use App\Repository\MassageImageRepositoryInterface;

class MassageImageRepository extends BaseRepository implements MassageImageRepositoryInterface
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


