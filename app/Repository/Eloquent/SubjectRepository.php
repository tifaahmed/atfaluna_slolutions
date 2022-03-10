<?php

namespace App\Repository\Eloquent;

use App\Models\Subject as ModelName;
use App\Repository\SubjectRepositoryInterface;
use Auth ;
class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
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

	public function filterPaginate($sub_user_id,int $itemsNumber)  
    {
		if($sub_user_id){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$result =$sub_user->subUserSubject();
			return $this->queryPaginate($result,$itemsNumber);
		}else{
			return $this->collection( $itemsNumber)  ;
		}
    }
	public function filterAll($sub_user_id)  
    {
		if($sub_user_id){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			return $sub_user->subUserSubject()->get();
		}else{
			return $this->all()  ;
		}
	}
	

	
}

