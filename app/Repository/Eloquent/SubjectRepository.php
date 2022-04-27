<?php

namespace App\Repository\Eloquent;

use App\Models\Subject as ModelName;
use App\Repository\SubjectRepositoryInterface;
use Auth ;
use App\Models\Quiz;             // morphedByMany
use Illuminate\Http\Response ;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
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

	public function filterPaginate($sub_user_id,$age_group_id, int $itemsNumber)  
    {
		if($sub_user_id && $age_group_id == null){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$active_subjects_query = $sub_user->ActiveSubjectsFromActiveAgeGroup();
			if ($active_subjects_query) {
				return $this->queryPaginate($active_subjects_query,$itemsNumber);
			}else{
				return abort( Response::HTTP_NOT_FOUND , 'there is no active_subjects for this child');
			}
		}else if($sub_user_id == null && $age_group_id){
			$result = $this->model->where('age_group_id',$age_group_id);
			return $this->queryPaginate($result,$itemsNumber);
		}else{
			return $this->collection( $itemsNumber)  ;
		}
    }
	public function filterAll($sub_user_id,$age_group_id)  
    {
		if($sub_user_id && $age_group_id == null){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$result = $sub_user->ActiveSubjectsFromActiveAgeGroup()->get();
			return $result;
		}else if($sub_user_id == null && $age_group_id){
			$result = $this->model->where('age_group_id',$age_group_id)->get();
			return $result;
		}
		else{
			return $this->all()  ;
		}
	}
	public function attachQuiz($quiz_id,$id)  
    {
		if($quiz_id){
			$sub_subject = $this->findById($id); 
			
			$sub_subject_quizzes =  $sub_subject->quiz()->get();
			$sub_subject_quizzes->each(function($quiz) {
				$quiz->update(['quizable_id'=>null,'quizable_type'=>null]); 
			});

			$quiz =  Quiz::find($quiz_id);
			$quiz->update(['quizable_id'=>$id,'quizable_type'=>$sub_subject::class]); 
		}
	}
	
}

