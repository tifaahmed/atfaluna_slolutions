<?php

namespace App\Repository\Eloquent;

use App\Models\Massage as ModelName;
use App\Repository\MassageRepositoryInterface;

class MassageRepository extends BaseRepository implements MassageRepositoryInterface
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

	public function filter($conversation_id)  {
		$model =   $this->model;
		if($conversation_id){
			$model = $model->where('conversation_id',$conversation_id) ;
		}
		return 	$model;
	}
	public function filterAll($conversation_id)  
    {
		$model = $this->filter($conversation_id)  ;
		return $model->get();
	}
	public function filterPaginate($conversation_id,$itemsNumber)  
    {
		$model = $this->filter($conversation_id)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
    }


}


