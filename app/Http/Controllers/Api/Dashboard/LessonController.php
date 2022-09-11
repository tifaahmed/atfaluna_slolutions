<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\Lesson\LessonApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Lesson\LessonUpdateApiRequest as modelUpdateRequest;

// Resources
// use App\Http\Resources\Dashboard\Collections\Lesson\LessonCollection as ModelCollection;
// use App\Http\Resources\Dashboard\Lesson\LessonResource as ModelResource;
use App\Http\Resources\Dashboard\Collections\ControllerResources\LessonController\LessonCollection as ModelCollection;
use App\Http\Resources\Dashboard\ControllerResources\LessonController\LessonResource as ModelResource;
// lInterfaces
use App\Repository\LessonRepositoryInterface as ModelInterface;
use App\Repository\LessonLanguageRepositoryInterface as ModelInterfaceLanguage; //Languages



class LessonController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
    public function __construct(ModelInterface $Repository,ModelInterfaceLanguage $RepositoryLanguage)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositoryLanguage = $RepositoryLanguage;
        $this->folder_name = 'lesson/'.Str::random(10).time();
        $this->related_language = 'lesson_id';
        $this->notification_image_name = 'image_one';
    }
    public function all(Request $request){
        try {
            $model =  $this->ModelRepository->filterAll(
                $request->sub_user_id,
                $request->lesson_type_id,
                $request->hero_id,
                $request->seen,
                $request->age_group_id
                ) ;

                return new ModelCollection ( $model )  ;
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
            $model = $this->ModelRepository->filterPaginate(
                $request->sub_user_id,
                $request->lesson_type_id,
                $request->hero_id, 
                $request->seen,
                $request->age_group_id,
                $request->prepage ? $request->prepage : 10);
                return new ModelCollection ( $model )  ;
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
    public function store(modelInsertRequest $request) {

        try {
            // create
            $model = new ModelResource( $this->ModelRepository->create( Request()->all() ) );

            // quiz
            $this->ModelRepository->attachQuiz($request->quiz_ids,$model->id);
            
            // skills
            $this->ModelRepository->attachSkills($request->skill_ids,$model->id);

            // languages
            $this -> store_array_languages($request->languages,$model) ;

            // notifications
            $this -> notification($request->notificate,$request->notification,$model) ;
            
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


    public function update(modelUpdateRequest $request ,$id) {
        try {
            $this->ModelRepository->update( $id,Request()->all()) ;
            $model = new ModelResource( $this->ModelRepository->findById($id) ); 

            // quiz
            $this->ModelRepository->attachQuiz($request->quiz_ids,$id);
            
            // skills
            $this->ModelRepository->attachSkills($request->skill_ids,$model->id);
            
            // languages
            $this -> update_array_languages($request->languages,$model) ;

            // notifications
            $this -> notification($request->notificate,$request->notification,$model) ;

            return $this -> MakeResponseSuccessful( 
                    [ $model],
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
    
    // lang

        // lang create
            //  requested_languages : from data request (array)
            //  model : single row of the main table (collection)
            //  handle languages  & store languages
            public function store_array_languages($requested_languages,$model) {
                if (is_array($requested_languages) ) {
                    foreach ($requested_languages as $key => $language_sigle_row) {
                        // insert relation_id_name with relation_id to the associative arrsy  ; 
                        $language_array = $this->handleLanguageData($language_sigle_row,$this->related_language,$model->id);
                        $this ->storeLanguage(  $language_array  );
                    }
                }
            }
            //  language_array : single associative array ready to enter table; 
            //  add new files && create data
            public function storeLanguage($language_array ) {
                $all = [ ];
                foreach ($language_array as $key => $value) {
                    if ( $key == 'image_one'||$key == 'image_two'|| $key == 'url') {
                        if (isset($language_array[$key]) && $language_array[$key]) {    
                            // store the gevin file or image
                            // if zip store in folder & axtract (else) just store   
                            $path =  $this->HelperHandleFile($this->folder_name,$language_array[$key],$key)  ;
                            $all += array( $key => $path );
                        }
                    }else{
                        $all += array( $key => $value );
                    }
                }
                $this->ModelRepositoryLanguage->create( $all ) ;
            }
        // lang create

        // lang update
            //  requested_languages : from data request (array)
            //  model : single row of the main table (collection)
            //  handle languages  & update languages
            public function update_array_languages($requested_languages,$model) {
                if (is_array($requested_languages) ) {// for safty
                    foreach ($requested_languages as $key => $language_sigle_row) {
                        // handle single array ; 
                            $language_array = $this->handleLanguageData($language_sigle_row,$this->related_language,$model->id);
                        // language_array : single array ready to enter table; 
                        // model : single row of a main table (collection)
                        // update single row of lang table ; 
                        $this ->updateLanguage($model,$language_array);
                    }
                }
            }
            //  model : single row of a main table (collection)
            //  language_array : single associative array ready to enter table; 
            //  delete old files & add new one && update data
            public function updateLanguage($model,$language_array ) {
                // get all row of language table
                    $language_models  =  $model->lesson_languages()->get() ;
                // get single row of language table
                    $language_model  = $language_models->where('language',$language_array['language'])->first() ;
                $all = [ ];
                foreach ($language_array as $key => $value) {
                    if ( $value && $key == 'image_one' || $key == 'image_two'||$key == 'url' ) {
                        // check file value
                        if (isset($language_array[$key]) && $language_array[$key]) {
                            // get the old directory
                            $old_folder_location = null ;
                            if ( isset($language_model->$key) && $language_model->$key ) {
                                $old_folder_location = $this->HelperGetDirectory($language_model->$key); 
                                // delete the old file or image
                                $this->HelperDelete($language_model->$key); 
                            }
                            $folder_location = $old_folder_location ? $old_folder_location : $this->folder_name;
                            
                            // store the gevin file or image
                            $path =  $this->HelperHandleFile($folder_location,$language_array[$key],$key)  ;
                            $all += array( $key => $path );
                        }
                    }else{
                        $all += array( $key => $value );
                    }
                }
                // for safty
                if($language_model ){
                    $this->ModelRepositoryLanguage->update( $language_model->id,$all ) ;
                }else{
                    $this->ModelRepositoryLanguage->create( $all ) ;
                }
            }
        // lang update

    // lang

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
        public function premanently_delete($id) {
            try {
                $model = $this->ModelRepository->findTrashedById($id);

                // get all related language
                $language_models = $model->lesson_languages()->get();
                $language_file_key_names =['image_one','image_two','url'];

                foreach ($language_models as  $language_model) {
                    foreach ($language_file_key_names as $value) {
                        //delete folder that has all this row files if exists
                        $this->HelperDeleteDirectory($this->HelperGetDirectory($language_model->$value));
                    }
                    //delete all this row files if exists
                    $this->HandleFileDelete($language_model,$language_file_key_names);
                }
                $this->ModelRepository->PremanentlyDeleteById($id);

                return $this -> MakeResponseSuccessful( 
                    [$model] ,
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

    // notifications
    public function notification($notificate = 0,$notification_data,$model) {
        if ($notificate && $notification_data) {
            $image_name = $this->notification_image_name ;
            for ($i=0; $i < count($notification_data) ; $i++) { 
                $image = asset($model->lesson_languages->where('language',$notification_data[$i]['lang'])->first()->$image_name);
                $model_id = $model->id;
            }
            $this -> TraitNotification($notification_data,$priority='high',$image,$model_name='lesson',$model_id);
        }
    }
}