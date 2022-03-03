<?php

namespace App\Repository\Eloquent;

use App\Models\Avatar as ModelName;
use App\Repository\AvatarRepositoryInterface;

class AvatarRepository extends BaseRepository implements AvatarRepositoryInterface
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


	public function filterPaginate($gender,int $itemsNumber)  
    {
		$result =   $this->model->Gender($gender);
		return $this->queryPaginate($result,$itemsNumber);
    }

	
}

