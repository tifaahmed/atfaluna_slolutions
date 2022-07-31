<?php

namespace App\Repository;

interface QuizRepositoryInterface extends EloquentRepositoryInterface{
    public function attachMcqQuestions($mcq_question_ids,$id);
    public function attachTrueFalseQuestions($true_false_question_ids,$id);
    public function attachMatchQuestions($match_questions_ids,$id);
    
    public function startQuiz(int $sub_user_id,int $quiz_id);
    public function answerQuestion(int $sub_user_id,int $quiz_id,int $question_attempt_id ,$answer);
    public function finishQuiz(int $sub_user_id,int $quiz_id);

    public function filterAll($quizable_id,$quizable_type)  ;
	public function filterPaginate($quizable_id,$quizable_type,int $per_page) ; 
}
