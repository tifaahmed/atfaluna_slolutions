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


	public function filter($original)  {
		$model =   $this->model;
		if($original){
			$model = $model->Original() ;
		}else if ($original == '0' ){
			$model = $model->NotOriginal() ;
		}
		return 	$model;
	}
	public function filterAll($original)  
    {
		$model = $this->filter($original)  ;
		return $model->get();
	}
	public function filterPaginate($original,$itemsNumber)  
    {
		$model = $this->filter($original)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
    }



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

