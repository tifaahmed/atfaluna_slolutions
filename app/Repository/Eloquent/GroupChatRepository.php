<?php

namespace App\Repository\Eloquent;

use App\Models\Group_chat as ModelName;
use App\Repository\GroupChatRepositoryInterface;

class GroupChatRepository extends BaseRepository implements GroupChatRepositoryInterface
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


