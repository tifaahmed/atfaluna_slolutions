<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_subject as ModelName;
use App\Models\Subject;
use App\Models\Quiz;

use App\Repository\SubSubjectRepositoryInterface;

class SubSubjectRepository extends BaseRepository implements SubSubjectRepositoryInterface
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


	public function filterPaginate($subject_id,int $itemsNumber)  
    {
		if($subject_id){
			$subject = Subject::find($subject_id);
			$result =$subject->sub_subjects();
			return $this->queryPaginate($result,$itemsNumber);
		}else{
			return $this->collection( $itemsNumber)  ;
		}
    }
	public function filterAll($subject_id)  
    {
		if($subject_id){
			$subject = Subject::find($subject_id);
			return $subject->sub_subjects()->get();
		}else{
			return $this->all()  ;
		}
	}
	public function attachQuiz($quiz_id,$id)  
    {
			$sub_subject = $this->findById($id); 	
			$sub_subject_quizzes =  $sub_subject->quiz()->get();
			foreach ($sub_subject_quizzes as $key => $value) {
				$value->quizable()->dissociate()->save();
			}
			$quiz =  Quiz::find($quiz_id);
			$quiz->quizable()->associate($sub_subject)->save(); 
	}
	public function attachSkills($skill_id,$id)
	{
		if($skill_id){
			$result = $this->findById($id); 
			return $result->skills()->sync($skill_id);
		}
	}
}