<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\QuizController\QuizCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\QuizController\QuizResource as ModelResource;


use App\Http\Resources\Mobile\QuizAttempt\QuizAttemptResource ;
use App\Http\Resources\Mobile\QuestionAttempt\QuestionAttemptResource ;


// lInterfaces
use App\Repository\QuizRepositoryInterface as ModelInterface;

use App\Http\Requests\Api\Quiz\MobileQuizApiRequest;
use App\Http\Requests\Api\Quiz\MobileAnswerQuizApiRequest;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll(
                $request->quizable_id,
                $request->quizable_type,
                $request->quiz_type_id,
                $request->sub_user_id,
            );
            return new ModelCollection ( $model  )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function collection(Request $request){
        $model = $this->ModelRepository->filterPaginate( 
            $request->quizable_id,
            $request->quizable_type,
            $request->quiz_type_id,
            $request->sub_user_id,
            $request->per_page ? $request->per_page : 10
        );      
        try {
            return new ModelCollection (  $model )  ;

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
            $quiz_attempt = $this->ModelRepository->startQuiz($request->sub_user_id,$request->quiz_id);
            return $this -> MakeResponseSuccessful( 
                [  new QuizAttemptResource ($quiz_attempt )  ],
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

    public function answerQuestion(MobileAnswerQuizApiRequest $request){
        try {
            $answered_question = $this->ModelRepository->answerQuestion(
                 $request->sub_user_id,      
                 $request->quiz_id,
                 $request->question_attempt_id,
                 $request->answer
            );
            return $this -> MakeResponseSuccessful( 
                [ new QuestionAttemptResource ($answered_question)   ],
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
        try {
            $quiz_attempt = $this->ModelRepository->finishQuiz($request->sub_user_id,$request->quiz_id);
            return $this -> MakeResponseSuccessful( 
                [  new QuizAttemptResource ($quiz_attempt )  ],
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