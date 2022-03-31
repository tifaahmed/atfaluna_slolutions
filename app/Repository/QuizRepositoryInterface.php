<?php

namespace App\Repository;

interface QuizRepositoryInterface extends EloquentRepositoryInterface{
    public function attachMcqQuestions($mcq_question_ids,$id);
    public function attachTrueFalseQuestions($true_false_question_ids,$id);
}
