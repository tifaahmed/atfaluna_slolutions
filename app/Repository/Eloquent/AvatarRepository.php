<?php

namespace App\Repository\Eloquent;

use App\Models\Avatar as ModelName;
use App\Repository\AvatarRepositoryInterface;
use Illuminate\Support\Facades\Auth;

use \Illuminate\Database\Eloquent\Collection;
use URL;
use Illuminate\Http\Response ;
use Illuminate\Database\Eloquent\Builder;

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
	public function filter($sub_user_id,$gender,$free,$bought)  {
		$model =   $this->model;
		if ($gender) {
			$model = $model->Gender($gender);
		}
		if($free == '1'){
			$model = $model->Free();
		}
		if($free == '0'){
			$model = $model->HasPrice();
		}
		if($bought == '1'){
			$model = $model->whereHas('subUserAvatar', function (Builder $query) use($sub_user_id) {
				if($sub_user_id){
					$query->where('sub_user_id',$sub_user_id);
				}
			});
		}
		if($bought == '0'){
			$model = $model->whereDoesntHave('subUserAvatar', function (Builder $query) use($sub_user_id) {
				if($sub_user_id){
					$query->where('sub_user_id',$sub_user_id);
				}
			});
		}
		return 	$model;
	}

	public function filterAll($sub_user_id,$gender,$free,$bought)  
    {
		$model = $this->filter($sub_user_id,$gender,$free,$bought)  ;
		return $model->get()  ;
    }
	public function filterPaginate($sub_user_id,$gender,$free,$bought,int $itemsNumber)  
    {
		$model = $this->filter($sub_user_id,$gender,$free,$bought)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
	}

		
}

