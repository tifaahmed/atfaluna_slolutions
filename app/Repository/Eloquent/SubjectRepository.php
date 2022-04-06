<?php

namespace App\Repository\Eloquent;

use App\Models\Subject as ModelName;
use App\Repository\SubjectRepositoryInterface;
use Auth ;
use App\Models\Quiz;             // morphedByMany

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

	public function filterPaginate($sub_user_id,int $itemsNumber)  
    {
		$chick_sub_user = Auth::user()->sub_user()->find($sub_user_id);

		if( $sub_user_id && $chick_sub_user){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$result = $sub_user->ActiveSubjectsFromActiveAgeGroup();
			return $this->queryPaginate($result,$itemsNumber);
		}else{
			return $this->collection( $itemsNumber)  ;
		}
    }
	public function filterAll($sub_user_id)  
    {
		if($sub_user_id){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$result = $sub_user->ActiveSubjectsFromActiveAgeGroup()->get();
			return $result;
		}else{
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

