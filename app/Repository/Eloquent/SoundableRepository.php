<?php

namespace App\Repository\Eloquent;

use App\Models\Soundable as ModelName;
use App\Repository\SoundableRepositoryInterface;

class SoundableRepository extends BaseRepository implements SoundableRepositoryInterface
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


