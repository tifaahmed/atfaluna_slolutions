<?php

namespace App\Repository;

interface TrueFalseQuestionRepositoryInterface extends EloquentRepositoryInterface{

    public function attachQuestionTags($question_tag_ids,$id);

}
