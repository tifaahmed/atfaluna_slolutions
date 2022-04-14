<?php

namespace App\Repository\Eloquent;

use App\Models\Conversation as ModelName;
use App\Repository\ConversationRepositoryInterface;

class ConversationRepository extends BaseRepository implements ConversationRepositoryInterface
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


