<?php

namespace App\Repository\Eloquent;

use App\Models\Friend as ModelName;
use App\Repository\FriendRepositoryInterface;

class FriendRepository extends BaseRepository implements FriendRepositoryInterface
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


