<?php

namespace App\Repository\Eloquent;

use App\Models\Quiz as ModelName;
use App\Repository\QuizRepositoryInterface;
use Auth;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Sub_subject;
use App\Models\Sub_user_certificate;
use Illuminate\Database\Eloquent\Builder;

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
	public function filter($quizable_id,$quizable_type,$quiz_type_id,$sub_user_id)   {
		$model =   $this->model;

		$model = $this->model->whereHas('quiz_questionable', function (Builder $query) {
        });


		if($quizable_id){
			$model = $model->where('quizable_id',$quizable_id);
		}
		if($quizable_type){
			switch ($quizable_type) {
				case "lesson":
					$quizable_type =  Lesson::class;
				  break;
				case "subject":
					$quizable_type =  Subject::class;
				  break;
				case "sub_subject":
					$quizable_type =  Sub_subject::class;
				  break;
				default:
				$quizable_type =  "";
			}
			$model = $model->where('quizable_type',$quizable_type);
		}
		if($quiz_type_id){
			$model = $model->where('quiz_type_id',$quiz_type_id);
		}

		

		return 	$model;

	}

    public function  filterAll($quizable_id,$quizable_type,$quiz_type_id,$sub_user_id)  {
		$model = $this->filter($quizable_id,$quizable_type,$quiz_type_id,$sub_user_id)  ;
		return $model->get();
	}
	public function filterPaginate($quizable_id,$quizable_type,$quiz_type_id,$sub_user_id,$per_page) {
			$model = $this->filter($quizable_id,$quizable_type,$quiz_type_id,$sub_user_id)  ;
			return $model->paginate($per_page)->appends(request()->query());
	} 



    public function attachMcqQuestions($mcq_question_ids,$id)
	{
		if($mcq_question_ids){
			$result = $this->findById($id); 
			$result->mcq_questions()->sync($mcq_question_ids);
	
		}
	}
	public function attachTrueFalseQuestions($true_false_question_ids,$id)
	{
		if($true_false_question_ids){
			$result = $this->findById($id); 
			$result->true_false_questions()->sync($true_false_question_ids);
		}
	}
	public function attachMatchQuestions($match_questions_ids,$id)
	{
		if($match_questions_ids){
			$result = $this->findById($id); 
			$result->match_questions()->sync($match_questions_ids);
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

					
		// if didn't pass yet
		if (!$sub_user_quiz->pass) {

			if ($quiz_attempt_open) {  
	
				//get the score from correct Questions to get Quiz Attempt Score ( update quiz_attempts row )
				//close all Quiz Attempt Questions  ( update question_attempts rows )
				$this->RegisterQuizAttemptScoreAndCloseQuestions($quiz_attempt_open);
	
				//get the max score from all Quiz Attempt  ( update sub_user_quizs row  score column)
				$this->RegisterQuizMaxScore($sub_user_quiz);
	
	
				//proces to mark the Quiz to get reword ( update sub_user_quizs row pass column && sub_user row point column)
				$this->markQuizGaveReword($quiz,$sub_user_quiz,$sub_user);
	
				// if child pass in the quiz
				if ($sub_user_quiz->pass) {
					//proces to add point to certificate
					$this->RegisterCertificationsPoints($quiz,$sub_user);
				}
			}	
		}else{
			if ($quiz_attempt_open) {  
	
				//get the score from correct Questions to get Quiz Attempt Score ( update quiz_attempts row )
				//close all Quiz Attempt Questions  ( update question_attempts rows )
				$this->RegisterQuizAttemptScoreAndCloseQuestions($quiz_attempt_open);
	
				//get the max score from all Quiz Attempt  ( update sub_user_quizs row  score column)
				$this->RegisterQuizMaxScore($sub_user_quiz);
	
			}	
		}
        


		

        return $sub_user_quiz->quiz_attempts()->get()->last();

	}
	public function RegisterCertificationsPoints($quiz,$sub_user){
		if ($quiz->quizable) {
			// if morph to quizable(App\Models\Subject)
			if ($quiz->quizable->certificate) {
				$subject = $quiz->quizable;
			}
			// if morph to quizable(App\Models\subSubject)
			else if($quiz->quizable->subject){
				$subject = $quiz->quizable->subject;
			}
			// if morph to quizable(App\Models\Lesson)
			else if($quiz->quizable->subSubject){
				$subject = $quiz->quizable->subSubject->subject;
			}
			$subject_certificate_id = $subject->certificate->id ;
			$age_group_certificate_id = $subject->age_group->certificate->id ;
			$points = $quiz->points ;

			$this->attachRegisterCertificate($sub_user,$points,$subject_certificate_id);  
			$this->attachRegisterCertificate($sub_user,$points,$age_group_certificate_id);
		}
		
	}

	public function RegisterQuizAttemptScoreAndCloseQuestions($quiz_attempt_open){
	
		//  get the open quiz attempt . questions     (get)
		$all_question_attempts = $quiz_attempt_open->question_attempts();
		//  get the open quiz attempt .correct questions   (get) 
		$correct_question_attempts = $all_question_attempts->QuestionAttemptCorrect()->get();

		//  get the open quiz attempt .correct questions  . collect score  
		$score = 0;
		foreach ($correct_question_attempts as $key => $value) {
			$score = $score +  $value->questionable->degree;
		}
		//  put the quiz attempt score && close it
		$quiz_attempt_open->update([
			'score'=> $score,
			'status'=>'closed',
		]);

		//  close all quiz attempt questions . if any of them still open 
		$quiz_attempt_open->question_attempts()->update(['status'=>'closed']);

	}
	public function RegisterQuizMaxScore($sub_user_quiz){
            //  get max quiz attempt score
			$max_score = $sub_user_quiz->quiz_attempts()->max('score');
			$sub_user_quiz->update([                
                'score'=>$max_score,
            ]);
	}
	public function markQuizGaveReword($quiz,$sub_user_quiz,$sub_user){
            //  if he not pass in the test before  && fit the minimum_requirements to pass
            if (!$sub_user_quiz->pass && $sub_user_quiz->score >= $quiz->minimum_requirements   ) {
                //  pass in test
                $sub_user_quiz->update(['pass'=>true ]);
                //  get the point of the quiz
                $sub_user->update(['points' => $sub_user->points + $quiz->points]);
            }
	}

	
	// run three time when to get lesson  points & Sub Subject & Subject
	public function attachRegisterCertificate($sub_user,$points,$certificate_id)  : void{
		// i use model not conection to use boot on update
		//  boot to add next age group
		$sub_user_certificate = Sub_user_certificate::where('certificate_id',$certificate_id)
													->where('sub_user_id',$sub_user->id)
													->first();

		// if is exist or not add the conection with points
		if ($sub_user_certificate) {
			// add new point to the old point 
			$sub_user_certificate->update(['points' => $sub_user_certificate->points + $points]); 
		}else{
			// add only the new point
			$sub_user->subUserCertificate()->syncWithoutDetaching([$certificate_id => ['points' =>  $points]]);
		}
	}
}

