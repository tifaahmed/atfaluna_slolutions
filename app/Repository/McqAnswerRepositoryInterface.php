<?php

namespace App\Repository;

interface McqAnswerRepositoryInterface extends EloquentRepositoryInterface{
    public function attachQuestionTags($question_tag_ids,$id);
}
