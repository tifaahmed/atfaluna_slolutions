<?php

namespace App\Repository\Eloquent;

use App\Models\True_false_question as ModelName;
use App\Repository\TrueFalseQuestionRepositoryInterface;
use Auth ;
class TrueFalseQuestionRepository extends BaseRepository implements TrueFalseQuestionRepositoryInterface
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

    public function attachQuestionTags($question_tag_ids,$id)
	{
		if($question_tag_ids){
			$result = $this->findById($id); 
			// $result->subUserAvatar()->detach();
			return $result->question_tags()->sync($question_tag_ids);
		}
	}
	public function filterAll($quiz_id,$sub_user_id)  
    {
		if($quiz_id && $sub_user_id){
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$quiz = $sub_user->subUserQuiz()->wherePivot('quiz_id' ,$quiz_id)->get();
			return $quiz;
		}
		else{
			return $this->all()  ;
		}
	}
}

