<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_subject as ModelName;
use App\Repository\SubSubjectRepositoryInterface;

class SubSubjectRepository extends BaseRepository implements SubSubjectRepositoryInterface
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

