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
	public function filterAll($gender)  
    {
		$model =   $this->model;
		if ($gender) {
			$model = $model->Gender($gender);
		}
		return $model->get()  ;
    }
	public function filterPaginate($gender,int $itemsNumber)  
    {
		$model =   $this->model;
		if ($gender) {
			$model = $model->Gender($gender);
		}
		return $model->paginate($itemsNumber)->appends(request()->query());
		
	}
		
}

