<?php

namespace App\Repository\Eloquent;

use App\Models\Subject as ModelName;
use App\Repository\SubjectRepositoryInterface;
use App\Models\Quiz;             // morphedByMany
use App\Models\Certificate;             // morphedByMany
use Illuminate\Support\Facades\Auth;

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
				$result = $sub_user->ActiveSubjectsFromActiveAgeGroup();
				return $this->queryPaginate($result,$itemsNumber);
			}else if($sub_user_id == null && $age_group_id){
				$result = ModelName::where('age_group_id',$age_group_id);
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
			$result = ModelName::where('age_group_id',$age_group_id)->get();
			return $result;
		}
		else{
			return $this->all()  ;
		}
	}
	public function attachQuiz($quiz_id,$id)  
    {
		// if($quiz_id){
			$subject = $this->findById($id); 
			
			$subject_quizzes =  $subject->quiz()->get();
			foreach ($subject_quizzes as $key => $value) {
				$value->quizable()->dissociate()->save();
			}

			$quiz =  Quiz::find($quiz_id);
			$quiz->quizable()->associate($subject)->save();
	}
	public function attachCertificate($certificate_id,$id)  
    {
		// if($certificate_id){
			$subject = $this->findById($id); 
			
			$subject_certificates =  $subject->certificate()->get();
			foreach ($subject_certificates as $key => $value) {
				$value->certificatable()->dissociate()->save();
			}

			$certificate =  Certificate::find($certificate_id);
			$certificate->certificatable()->associate($subject)->save();
		// }
	}
}

