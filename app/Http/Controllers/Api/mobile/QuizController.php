<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\Quiz\QuizCollection as ModelCollection;
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

    public function answerQuestion(Request $request){
        try {
            $question_attempt = $this->ModelRepository->answerQuestion(
                 $request->sub_user_id,      
                 $request->quiz_id,
                 $request->question_attempt_id,
                 $request->answer
            );
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
        try {
            return $this->ModelRepository->finishQuiz($request->sub_user_id,$request->quiz_id);
        } catch (\Exception $e) {
        return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }


}