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
			$query = $query->get();
			$result = $result->merge( $query );		
		}
		if (!$result->count()) {
			return $result = $this->collection( $itemsNumber)  ;
		}else{
			return $this->paginate($result,$itemsNumber,null,URL::full());
		}
		
}

