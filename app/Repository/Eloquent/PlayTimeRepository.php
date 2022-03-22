<?php

namespace App\Repository\Eloquent;

use App\Models\Play_time as ModelName;
use App\Repository\PlayTimeRepositoryInterface;
use Auth;
class PlayTimeRepository extends BaseRepository implements PlayTimeRepositoryInterface
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
	public function filterAll($sub_user_id)  
    {
		if($sub_user_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$result   		= $sub_user->playTime()->get();
			return $result;
		}else{
			return $this->all()  ;
		}
	}
	public function filterPaginate($sub_user_id,$perPage) 
    {
		if($sub_user_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$result   = $sub_user->playTime();
			return $this->queryPaginate($result,$perPage);

		}else{
			return $this->collection( $perPage)  ;
		}
    }

	public function attatchByArray($array) {
		$relation_name = 'sub_user_id';
		$sub_user       = Auth::user()->sub_user()->find($array[$relation_name]);
		$result   = $sub_user->playTime()->get();
		if ($result->count()) {
			return $this->updateByArray($array,$result,$relation_name) ;
		}else{
			$this->createByArray($array,$relation_name) ;
		}
	}

	public function updateByArray($array,$result,$relation_name)  
	{
		foreach ($result as $i => $result_value) {
			$all = [];
			foreach ($array as $key => $value) {
				if ( $key == $relation_name) {
					$all +=  array($key=> $array[$key]);
				}else{
					$all +=  array($key => $array[$key][$i]);
				}
			}
			$this->update( $result_value->id ,$all  ) ;
		}
		return 'ttue';
	}

	public function createByArray($array,$relation_name)  
	{
		for ($i = 0; $i <= 6; $i++) {
			$all = [];
			foreach ($array as $key => $value) {
				if ( $key == $relation_name) {
					$all +=  array($key=> $array[$key]);
				}else{
					$all +=  array($key => $array[$key][$i]);
				}
			}
			$this->create( $all ) ;
		}
	}
}
