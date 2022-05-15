<?php

namespace App\Repository\Eloquent;

use App\Models\Sound as ModelName;
use App\Repository\SoundsRepositoryInterface;

class SoundsRepository extends BaseRepository implements SoundsRepositoryInterface
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

	// public function filterFirst($language)  
    // {	
	// 	$result=$this->model->Localization()->first();
	// 	return $result;
	// 	}
	}


