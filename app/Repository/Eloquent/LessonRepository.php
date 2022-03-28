<?php

namespace App\Repository\Eloquent;

use App\Models\Lesson as ModelName;
use App\Repository\LessonRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Sub_subject;
use App\Models\Subject;
use \Illuminate\Database\Eloquent\Collection;
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

	public function filterAll($sub_user_id,$lesson_type_id)  
    {
		if($sub_user_id && $lesson_type_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$subjects   = $sub_user->subUserSubject()->has('lesssons')->get();
			$result = new Collection;
			foreach ($subjects as $key => $value) {
				$lesssons = $value->lesssons()->where('lesson_type_id',$lesson_type_id)->get();
				$result = $result->merge( $lesssons );
			}
			return $result;
		}else{
			return $this->all()  ;
		}
	}
	public function filterPaginate($sub_user_id,$lesson_type_id,$itemsNumber)  
    {
		if($sub_user_id && $lesson_type_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$subjects   = $sub_user->subUserSubject()->has('lesssons')->get();
			$result = new Collection;
			foreach ($subjects as $key => $value) {
				$lesssons = $value->lesssons()->where('lesson_type_id',$lesson_type_id)->get();
				$result = $result->merge( $lesssons );
			}
			return $this->queryPaginate($result,$itemsNumber);
		}else{
			return $this->collection( $itemsNumber)  ;
		}
    }

	
}

