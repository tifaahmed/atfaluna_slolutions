<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Auth;

// Resources
use App\Http\Resources\Mobile\Collections\McqQuestion\McqQuestionCollection as ModelCollection;
use App\Http\Resources\Mobile\McqQuestion\McqQuestionResource as ModelResource;


// lInterfaces
use App\Repository\McqQuestionRepositoryInterface as ModelInterface;


class McqQuestionController extends Controller
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
    public function attach(Request $request){
        try {
             $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);

            $sub_user_quiz = $sub_user->subUserQuizModel()->where('quiz_id',$request->quiz_id)->first();

            
            $quiz_attempt_open = $sub_user_quiz->quiz_attempts()->QuizAttemptOpen()->first();
            
            // return $question_attempt = $quiz_attempt_open->question_attempt()->first();

            $mcq_question = $this->ModelRepository->findById($request->mcq_question_id);

            return $question_attempt_open = $mcq_question->question_attempts()->QuestionAttemptOpen()->where('quiz_attempt_id',$quiz_attempt_open->id)->get();

            // ->question_attempt()->get();
            //  return $quiz_attempt_open()->question_attempt()->get();
            // $question_attempt->create();
            // if (!$quiz_attempt_open) {
            //     $quiz_attempt->create();
            // }
            return $this -> MakeResponseSuccessful( 
                [  $quiz_attempt->first()   ],
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
    
}