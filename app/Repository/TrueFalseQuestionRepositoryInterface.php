<?php

namespace App\Repository;

interface TrueFalseQuestionRepositoryInterface extends EloquentRepositoryInterface{

    public function attachQuestionTags($question_tag_ids,$id);
	public function filterAll($quiz_id,$sub_user_id);  
}
