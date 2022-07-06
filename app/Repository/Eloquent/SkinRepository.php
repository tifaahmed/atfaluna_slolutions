<?php

namespace App\Repository\Eloquent;

use App\Models\Skin as ModelName;
use App\Repository\SkinRepositoryInterface;
use Illuminate\Support\Facades\Auth;

use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use URL;

class SkinRepository extends BaseRepository implements SkinRepositoryInterface
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
	// public function filterAll($free,$sub_user_id)  
    // {
	// 	$result = null ;

	// 	if ($sub_user_id) {
	// 		$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
	// 		$sub_user_skins =  $sub_user->subUserSkin()->get();	
	// 		$result = $this->model->merge( $sub_user_skins );
	// 	}

	// 	else{
	// 		return $this->all()  ;
	// 	}	
    // }
	// public function filterPaginate($free,$sub_user_id,int $itemsNumber)  
    // {
		
	// 	$result = new Collection() ;

	// 	if ($sub_user_id) {
	// 		$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
	// 		$sub_user_skins =  $sub_user->subUserSkin()->get();	
	// 		$result = $this->model->merge( $sub_user_skins );
	// 	}


	// 	if (!$result->count()) {
	// 		return $result = $this->collection( $itemsNumber)  ;
	// 	}else{
	// 		return $this->paginate($result,$itemsNumber,null,URL::full());
	// 	}
		

    // }



    public function OnlyOneOriginal($skin_id)
	{
		$skin = $this->findById($skin_id);

		if ( $skin->original == 1 ) {
			$this->model
			->where('avatar_id', $skin->avatar_id)
			->where('id','!=',$skin->id)
			->where('original',1)
			->update(['original'=>0]);		
		}

	}

	
}

