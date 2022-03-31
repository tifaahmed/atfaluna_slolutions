<?php

namespace App\Repository\Eloquent;

use App\Models\Quiz as ModelName;
use App\Repository\QuizRepositoryInterface;

class QuizRepository extends BaseRepository implements QuizRepositoryInterface
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

    public function attachMcqQuestions($mcq_question_ids,$id)
	{
		if($mcq_question_ids){
			$result = $this->findById($id); 
			$result->mcq_questions()->syncWithoutDetaching($mcq_question_ids);
	
		}
	}
	public function attachTrueFalseQuestions($true_false_question_ids,$id)
	{
		if($true_false_question_ids){
			$result = $this->findById($id); 
			$result->true_false_questions()->syncWithoutDetaching($true_false_question_ids);
		}
	}


	
}

