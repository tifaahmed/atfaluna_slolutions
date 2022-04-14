<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\QuizCollection as ModelCollection;
use App\Http\Resources\Mobile\Quiz\QuizResource as ModelResource;
use App\Http\Resources\Mobile\QuizAttempt\QuizAttemptResource ;


// lInterfaces
use App\Repository\QuizRepositoryInterface as ModelInterface;
use App\Http\Requests\Api\Quiz\MobileQuizApiRequest;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(){
        try {
            return new ModelCollection (  $this->ModelRepository->all() )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function collection(Request $request){
        // return $request->language;
        try {
            return new ModelCollection (  $this->ModelRepository->collection( $request->PerPage ? $request->PerPage : 10) )  ;

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    

    public function show($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($id) )  ],
                'Successful',
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    // relation
    public function startQuiz(MobileQuizApiRequest $request){
        try {
            $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);
            $sub_user->subUserQuiz()->syncWithoutDetaching($request->quiz_id);
            $subUserQuiz = $sub_user->subUserQuizModel()->where('quiz_id',$request->quiz_id)->first();

            $quiz_attempt = $subUserQuiz->quiz_attempts();
            //
            $quiz_attempt = $quiz_attempt->QuizAttemptOpen()->first();

            if (!$quiz_attempt) {

                $quiz_attempt = $quiz_attempt->create();

                // add all question with open status
                $quiz = $this->ModelRepository->findById($request->quiz_id);
                $quiz_questions = $quiz->quiz_questionable()->get();
                foreach ($quiz_questions as $key => $value) {
                    $quiz_attempt->question_attempts()->create([
                        'questionable_id'=> $value->questionable_id,
                        'questionable_type'=> $value->questionable_type
                        ]
                    );
                }
                 
            }

            return $this -> MakeResponseSuccessful( 
                [  new QuizAttemptResource ($quiz_attempt->first() )  ],
                'Successful',
                Response::HTTP_OK
            ) ;

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    } 

    public function answerQuestion(Request $request){
        try {

            $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);
            $sub_user_quiz = $sub_user->subUserQuizModel()->where('quiz_id',$request->quiz_id)->first();
            $quiz_attempt_open = $sub_user_quiz->quiz_attempts()->QuizAttemptOpen()->first();
            
            $question_attempt = $quiz_attempt_open->question_attempts()->QuestionAttemptOpen()->find($request->question_attempt_id);

            if ($question_attempt) {
                $question_attempt->update([
                    'answer'=>$request->answer,
                    'status'=>'closed',
                ]);
            }

            return $this -> MakeResponseSuccessful( 
                [ $question_attempt   ],
                'Successful',
                Response::HTTP_OK
            ) ;

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    } 

    public function finishQuiz(MobileQuizApiRequest $request){
        $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);
        $sub_user_quiz = $sub_user->subUserQuizModel()->where('quiz_id',$request->quiz_id)->first();
        $quiz_attempt= $sub_user_quiz->quiz_attempts();
        $quiz_attempt_open = $quiz_attempt->QuizAttemptOpen()->first();

        $question_attempt = $quiz_attempt_open->question_attempts()->get();

        $score = 0;
        foreach ($question_attempt as $key => $value) {
            $score = $score + $value->score;
        }

        if ($quiz_attempt_open) {
            $quiz_attempt_open->update([
                'status'=>'closed',
                'score'=>$score,
            ]);
        }

        $sub_user_quiz->update([                
            'score'=>$quiz_attempt-max('score')->first(),
        ]);
        
    }


}