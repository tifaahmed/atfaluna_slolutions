<?php

namespace App\Repository\Eloquent;

use App\Models\About_us as ModelName;
use App\Repository\AboutUsRepositoryInterface;

class AboutUsRepository extends BaseRepository implements AboutUsRepositoryInterface
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

	public function filterFirst($language)  
    {	
		$result=$this->model->Localization()->first();
		return $result;
	}
	public function filterPaginate($itemsNumber)  
    {
			return $this->collection( $itemsNumber)  ;
		}
    }