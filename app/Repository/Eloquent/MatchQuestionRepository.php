<?php

namespace App\Repository\Eloquent;

use App\Models\Match_question as ModelName;
use App\Repository\MatchQuestionRepositoryInterface;

class MatchQuestionRepository extends BaseRepository implements MatchQuestionRepositoryInterface
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
			return $result->question_tags()->sync($question_tag_ids);
		}
	}

}

