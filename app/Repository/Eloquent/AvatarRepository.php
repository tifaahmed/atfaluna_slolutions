<?php

namespace App\Repository\Eloquent;

use App\Models\Avatar as ModelName;
use App\Repository\AvatarRepositoryInterface;
use Illuminate\Support\Facades\Auth;

use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use URL;
use Illuminate\Http\Response ;
use App\Models\Massage;
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
	public function filterAll($gender,$free,$sub_user_id)  
    {
		$model =   $this->model;
		if ($gender || $free || $sub_user_id) {
			if ($gender) {
				$model = $model->Gender($gender);
			}
			if($free == '1'){
				$model = $model->Free();
			}
			if($free == '0'){
				$model = $model->HasPrice();
			}
			if($sub_user_id ){
				$model = $model->whereHas('subUserAvatar', function (Builder $query) use($sub_user_id) {
					$query->where('id',$sub_user_id);
				});
			}
		} 
		return $model->get()  ;
    }
	public function filterPaginate($gender,$free,$sub_user_id,int $itemsNumber)  
    {
		$model =   $this->model;

		if ($gender || $free || $sub_user_id) {
			if ($gender) {
				$model = $model->Gender($gender);
			}
			if($free == '1'){
				$model = $model->Free();
			}
			if($free == '0'){
				$model = $model->HasPrice();
			}
			if($sub_user_id ){
				$model = $model->whereHas('subUserAvatar', function (Builder $query) use($sub_user_id) {
					$query->where('id',$sub_user_id);
				});
			}
		} 
		return $model->paginate($itemsNumber)->appends(request()->query());
	
    }

    public function paginate($items, $perPage = 10, $page = null, $baseUrl = null, $options = [])
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

		$items = $items instanceof Collection ? 
					$items : Collection::make($items);

		$lap = new LengthAwarePaginator($items->forPage($page, $perPage), 
						$items->count(),
						$perPage, $page, $options);

		if ($baseUrl) {
			$lap->setPath($baseUrl);
		}

		return $lap;
	}

	public function attachMassage($massage_id,$id)  
    {
			$avatar = $this->findById($id); 
			
			$avatar_massages =  $avatar->massage()->get();
			
			foreach ($avatar_massages as $key => $value) {
				$value->massagable()->dissociate()->save();
			}
			$massage =  Massage::find($massage_id);
			$massage->massagable()->associate($avatar)->save();
	}
}

