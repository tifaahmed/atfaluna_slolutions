<?php

namespace App\Repository\Eloquent;

use App\Models\Quiz as ModelName;
use App\Repository\QuizRepositoryInterface;
use Auth;
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
	public function startQuiz(int $sub_user_id,int $quiz_id){

		$sub_user =   Auth::user()->sub_user()->find($sub_user_id);

		// add new row in sub_user_quizzes 
		$sub_user->subUserQuiz()->syncWithoutDetaching($quiz_id);

		// get all  quiz attempts
		$subUserQuiz = $sub_user->subUserQuizModel()->where('quiz_id',$quiz_id)->first();
		$quiz_attempts = $subUserQuiz->quiz_attempts();
		
		// get the open quiz attempt
		$quiz_attempt_open = $quiz_attempts->QuizAttemptOpen()->first();

		// if there no open quiz attempt : create new
		if (!$quiz_attempt_open) {

			//first
			// create quiz_attempt with default status:open
			$quiz_attempt_open_new = $quiz_attempts->create();

			//second
			// add all question_ids of the quiz to the quiz_attempt with default status:open
			$quiz = $this->findById($quiz_id);
			$quiz_questions = $quiz->quiz_questionable()->get();
			foreach ($quiz_questions as $key => $value) {
				$quiz_attempt_open_new->question_attempts()->create([
					'questionable_id'=> $value->questionable_id,
					'questionable_type'=> $value->questionable_type
					]
				);
			}
			$quiz_attempt_open = $quiz_attempts->QuizAttemptOpen()->first();
		}


		return $quiz_attempt_open;
	}
    public function answerQuestion(int $sub_user_id,int $quiz_id,int $question_attempt_id ,$answer){

		$sub_user =   Auth::user()->sub_user()->find($sub_user_id);
		$sub_user_quiz = $sub_user->subUserQuizModel()->where('quiz_id',$quiz_id)->first();
		$quiz_attempt_open = $sub_user_quiz->quiz_attempts()->QuizAttemptOpen()->first();
		
		$question_attempt = $quiz_attempt_open->question_attempts()->QuestionAttemptOpen()->find($question_attempt_id);

		if ($question_attempt) {
			$question_attempt->update([
				'answer'=>$answer,
				'status'=>'closed',
			]);
		}

		return $quiz_attempt_open->question_attempts()->find($question_attempt_id);;

	}

	public function finishQuiz(int $sub_user_id,int $quiz_id){
        // get the quiz (first)
		$quiz = $this->findById($quiz_id);
	 	// get the  child (first)
        $sub_user =   Auth::user()->sub_user()->find($sub_user_id);
        // get the relation child to the quiz (first)
        $sub_user_quiz = $sub_user->subUserQuizModel()->where('quiz_id',$quiz_id)->first();
        // get the all quiz attempts (get)
        $quiz_attempts= $sub_user_quiz->quiz_attempts();
        // get the open quiz attempt (first)
        $quiz_attempt_open = $quiz_attempts->QuizAttemptOpen()->first();

        if ($quiz_attempt_open) {  

			//get the score from correct Questions to get Quiz Attempt Score ( update quiz_attempts row )
			//close all Quiz Attempt Questions  ( update question_attempts rows )
			$this->RegisterQuizAttemptScoreAndCloseQuestions($quiz_attempt_open);

			//get the max score from all Quiz Attempt  ( update sub_user_quizs row )
			$this->RegisterQuizMaxScore($sub_user_quiz);


            //proces to mark the Quiz to get reword ( update sub_user_quizs row && sub_user row)
			$this->markQuizGaveReword($quiz,$sub_user_quiz,$sub_user);

			

			//proces to add point to certificate

        }
        return $sub_user_quiz->quiz_attempts()->get()->last();

	}
	public function RegisterQuizAttemptScoreAndCloseQuestions($quiz_attempt_open){
      
		// 5- get the open quiz attempt . questions     (get)
		$all_question_attempts = $quiz_attempt_open->question_attempts();
		// 6- get the open quiz attempt .correct questions   (get) 
		$correct_question_attempts = $all_question_attempts->QuestionAttemptCorrect()->get();

		// 7- get the open quiz attempt .correct questions  . collect score  
		$score = 0;
		foreach ($correct_question_attempts as $key => $value) {
			$score = $score +  $value->questionable->degree;
		}
		// 8- put the quiz attempt score && close it
		$quiz_attempt_open->update([
			'score'=> $score,
			'status'=>'closed',
		]);

		// 10- close all quiz attempt questions . if any of them still open 
		$quiz_attempt_open->question_attempts()->update(['status'=>'closed']);

	}
	public function RegisterQuizMaxScore($sub_user_quiz){
            // 9- get max quiz attempt score
			$max_score = $sub_user_quiz->quiz_attempts()->max('score');
			$sub_user_quiz->update([                
                'score'=>$max_score,
            ]);
	}
	public function markQuizGaveReword($quiz,$sub_user_quiz,$sub_user){
            // 2- if he not pass in the test before  && fit the minimum_requirements to pass
            if (!$sub_user_quiz->pass && $sub_user_quiz->score >= $quiz->minimum_requirements   ) {
                // 3- pass in test
                $sub_user_quiz->update(['pass'=>true ]);
                // 4- get the point of the quiz
                $sub_user->update(['points' => $sub_user->points + $quiz->points]);
            }
	}

	
	
}

