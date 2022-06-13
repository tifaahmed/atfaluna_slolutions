<?php

namespace App\Repository\Eloquent;

use App\Models\Activity as ModelName;
use App\Repository\ActivityRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use URL;


class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface
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
	public function filterPaginate($lesson_id,$itemsNumber)  {
		if($lesson_id ){
			$activities =  ModelName::where('lesson_id',$lesson_id);
			return $this->queryPaginate($activities,$itemsNumber,null,URL::full());

		}else{
			return $this->collection( $itemsNumber)  ;
		}
	}

	public function filterAll($lesson_id){
		if($lesson_id ){
			return ModelName::where('lesson_id',$lesson_id)->get();
		}else{
			return $this->all()  ;
		}	
	}

}


