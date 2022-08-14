<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

//AgeGroupController
// Requests
use App\Http\Requests\Api\SubUser\SubUserApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\SubUserCollection as ModelCollection;
use App\Http\Resources\Dashboard\SubUserResource as ModelResource;

// lInterfaces
use App\Repository\SubUserRepositoryInterface as ModelInterface;

class SubUserController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }

    public function store(modelInsertRequest $request) {
        try {
            
            $model = new ModelResource( $this->ModelRepository->create( Request()->all() ));
                                //Avatar
            $this->ModelRepository->attachAvatars($request->avatar_ids,$model->id);
                                //Certificate
            $this->ModelRepository->attachCertificates($request->certificate_ids,$model->id);
                                //Accessory
            $this->ModelRepository->attachAccessories($request->accessory_ids,$model->id);
                                //Subject
            $this->ModelRepository->attachSubjects($request->subject_ids,$model->id);
                                //SubSubjects
            $this->ModelRepository->attachSubSubjects($request->sub_subject_ids,$model->id);
                                //Quiz
            $this->ModelRepository->attachQuizs($request->quiz_ids,$model->id);
                                //Lesson
            $this->ModelRepository->attachLessons($request->lesson_ids,$model->id);
                                //AgeGroup
            $this->ModelRepository->attachAgeGroups($request->age_group_ids,$model->id);

            return $this -> MakeResponseSuccessful( 
                [ $model ],
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function all(){
        try {
            $model = $this->ModelRepository->all();
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
        try {
            return  $model = $this->ModelRepository->collection( $request->PerPage ? $request->PerPage : 10);
            // return new ModelCollection ( $model )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    
    
    public function destroy($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [$this->ModelRepository->deleteById($id)] ,
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [ $e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function premanently_delete($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [$this->ModelRepository->PremanentlyDeleteById($id)] ,
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [ $e->getMessage()  ] ,
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
    
    public function update(modelInsertRequest $request ,$id) {
        try {
                        //Avatar
            $this->ModelRepository->attachAvatars($request->avatar_ids,$id);
                        //Certificate
            $this->ModelRepository->attachCertificates($request->certificate_ids,$id);
                        //Accessory
            $this->ModelRepository->attachAccessories($request->accessory_ids,$id);
                        //Subject
            $this->ModelRepository->attachSubjects($request->subject_ids,$id);
                        //SubSubjects
            $this->ModelRepository->attachSubSubjects($request->sub_subject_ids,$id);
                        //Quiz
            $this->ModelRepository->attachQuizs($request->quiz_ids,$id);
                        //Lesson
            $this->ModelRepository->attachLessons($request->lesson_ids,$id);
                        //AgeGroup
            $this->ModelRepository->attachAgeGroups($request->age_group_ids,$id);

            $modal = new ModelResource($this->ModelRepository->findById($id)); 

            return $this -> MakeResponseSuccessful( 
                    [ $modal],
                    'Successful'               ,
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

    // trash
        public function collection_trash(Request $request){
            try {
                return new ModelCollection (  $this->ModelRepository->collection_trash( $request->PerPage ? $request->PerPage : 10 ) ) ;
            } catch (\Exception $e) {
                return $this -> MakeResponseErrors(  
                    [$e->getMessage()  ] ,
                    'Errors',
                    Response::HTTP_NOT_FOUND
                );
            }
        }
        
        public function show_trash($id) {
            try {
                return $this -> MakeResponseSuccessful( 
                    [new ModelResource ( $this->ModelRepository->findTrashedById($id) )  ],
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

        public function restore($id) {
            try {
                return $this -> MakeResponseSuccessful( 
                    [ $this->ModelRepository->restorById($id)  ],
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
    // trash

}
