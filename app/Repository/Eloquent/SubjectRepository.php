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
		if($sub_user_id){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$result =$sub_user->subUserSubject();
			return $this->queryPaginate($result,$itemsNumber);
		}else{
			return $this->collection( $itemsNumber)  ;
		}
    }
	public function filterAll($sub_user_id)  
    {
		if($sub_user_id){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			return $sub_user->subUserActiveAgeGroup()->get();

			// return $sub_user->subUserSubject()->get();
		}else{
			return $this->all()  ;
		}
	}
	public function attachQuiz($quiz_id,$id)  
    {
		if($quiz_id){
			$subject = $this->findById($id); 
			$quiz =  Quiz::find($quiz_id);
			$subject_quizzes =  $subject->quiz()->get();

			$subject_quizzes->each(function($quiz) {
                $quiz->update(['quizable_id'=>null,'quizable_type'=>null]); 
            });
			$quiz->update(['quizable_id'=>$id,'quizable_type'=>$subject::class]); 
		}
	}
	
	
}

