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
		$result = null ;

		if ($sub_user_id) {
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$sub_user_avatars =  $sub_user->subUserAvatar()->get();	
			$result = $this->model->merge( $sub_user_avatars );
		}

		if ($gender || $free) {
			$query =   $this->model;
			if ($gender) {
				$query = $query->Gender($gender);
			}
			if($free == '1'){
				$query = $query->Free();
			}
			if($free == '0'){
				$query = $query->HasPrice();
			}
			$query = $query->get();
			$result = $result->merge( $query );	

		} if (!$result->count()) {
			return $result ;
		}
		else{
			return $this->all()  ;
		}	
    }
	public function filterPaginate($gender,$free,$sub_user_id,int $itemsNumber)  
    {
		
		$result = new Collection() ;

		if ($sub_user_id) {
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$sub_user_avatars =  $sub_user->subUserAvatar()->get();	
			$result = $result->merge( $sub_user_avatars );
		}

		if ($gender || $free) {
			$query =   $this->model;
			if ($gender) {
				$query = $query->Gender($gender);
			}
			if($free == '1'){
				$query = $query->Free();
			}
			if($free == '0'){
				$query = $query->HasPrice();
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

