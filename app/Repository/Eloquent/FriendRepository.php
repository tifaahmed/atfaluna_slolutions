<?php

namespace App\Repository\Eloquent;

use App\Models\Friend as ModelName;
use App\Repository\FriendRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class FriendRepository extends BaseRepository implements FriendRepositoryInterface
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

	public function filter($sub_user_id)  
	{
		$model =   $this->model;
		if($sub_user_id ){
			$model = $model->whereHas('sub_user_sender', function (Builder $query) use($sub_user_id) {
				$query->where('sub_user_id',$sub_user_id);
			});
		}
		return 	$model;
	}

	public function filterAll($sub_user_id)  
	{
		$model = $this->filter($sub_user_id)  ;
		return $model->get()  ;
	}

	public function filterPaginate($sub_user_id,int $itemsNumber)   
    {
		$model = $this->filter($sub_user_id)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
	}
	

}


