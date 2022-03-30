<?php

namespace App\Repository\Eloquent;

use App\Models\Mcq_question as ModelName;
use App\Repository\McqQuestionRepositoryInterface;

class McqQuestionRepository extends BaseRepository implements McqQuestionRepositoryInterface
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

}

