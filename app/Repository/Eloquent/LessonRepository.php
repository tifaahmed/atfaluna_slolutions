<?php

namespace App\Repository\Eloquent;

use App\Models\Lesson as ModelName;
use App\Repository\LessonRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Sub_subject;
use App\Models\Subject;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use URL;
class LessonRepository extends BaseRepository implements LessonRepositoryInterface
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

	public function filterAll($sub_user_id,$lesson_type_id,$hero_id)  
    {
		if($sub_user_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$subjects   = $sub_user->subUserSubject()->has('lesssons')->get();
			$result = new Collection;
			foreach ($subjects as $key => $value) {
				$lesssons = $value->lesssons();

				if($lesson_type_id){
					$lesssons = $lesssons->whereHas('lesson_type',function (Builder $query) use($lesson_type_id) {
						$query->where('id',$lesson_type_id);
					});
				}	
				if($hero_id){
					$lesssons = $lesssons->whereHas('herolesson',function (Builder $query) use($hero_id) {
						$query->where('hero_id',$hero_id);
					});
				}	

				$lesssons = $lesssons ->get();

				$result = $result->merge( $lesssons );
			}
			return $result;
		}
		else{
			return $this->all()  ;
		}
	}
	public function filterPaginate($sub_user_id,$lesson_type_id,$hero_id,$itemsNumber)  
    {
		if($sub_user_id && $lesson_type_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$subjects   = $sub_user->subUserSubject()->has('lesssons')->get();
			$result = new Collection() ;
			foreach ($subjects as $key => $value) {
				$lesssons = $value->lesssons();

				if($lesson_type_id){
					$lesssons = $lesssons->whereHas('lesson_type',function (Builder $query) use($lesson_type_id) {
						$query->where('id',$lesson_type_id);
					});
				}	
				if($hero_id){
					$lesssons = $lesssons->whereHas('herolesson',function (Builder $query) use($hero_id) {
						$query->where('hero_id',$hero_id);
					});
				}	

				$lesssons = $lesssons ->get();
				$result = $result->merge( $lesssons );
			}
			return $this->paginate($lesssons,$itemsNumber,null,URL::full());

		}else{
			return $this->collection( $itemsNumber)  ;
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
}

