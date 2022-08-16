<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\Subject\SubjectApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Subject\SubjectUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\SubjectCollection as ModelCollection;
use App\Http\Resources\Dashboard\Subject\SubjectResource as ModelResource;

// lInterfaces
use App\Repository\SubjectRepositoryInterface as ModelInterface;
use App\Repository\SubjectLanguageRepositoryInterface as ModelInterfaceLanguage; //Languages

class SubjectController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
    public function __construct(ModelInterface $Repository,ModelInterfaceLanguage $RepositoryLanguage)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositoryLanguage = $RepositoryLanguage;
        $this->folder_name = 'subject/'.Str::random(10).time();
        $this->related_language = 'subject_id';
        $this->notification_image_name = 'image';
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
    public function store(modelInsertRequest $request) {
        try {
            $all = [ ];
            $file_one = 'image';
            if ($request->hasFile($file_one)) {            
                $path = $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
                $all += array( $file_one => $path );
            }

            $model = new ModelResource( $this->ModelRepository->create( Request()->except($file_one)+$all ) );

            
            // attach Quiz
            if (isset($request->quiz_id) && $request->quiz_id) {
                $this->ModelRepository->attachQuiz($request->quiz_id,$model->id);
            }
    
            // attach skills
            $this->ModelRepository->attachSkills($request->skill_ids,$model->id);

            // attach Certificate
            $this->ModelRepository->attachCertificate($request->certificate_id,$model->id);

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
    
    public function update(modelUpdateRequest $request ,$id) {
        try {
            $old_model = new ModelResource( $this->ModelRepository->findById($id) );

            // attach Quiz
            if (isset($request->quiz_id) && $request->quiz_id) {
                $this->ModelRepository->attachQuiz($request->quiz_id,$id);
            }
            // attach skills
            $this->ModelRepository->attachSkills($request->skill_ids,$old_model->id);

            // attach Certificate
            $this->ModelRepository->attachCertificate($request->certificate_id,$old_model->id);
            // files
            $all = [ ];
            $file_one = 'image';
            if ( $request->hasFile($file_one) ) { 
                // get the old directory
                if ( $old_model->$file_one ) {
                    $old_folder_location = $this->HelperGetDirectory($old_model->$file_one); 
                    // delete the old file or image
                    $this->HelperDelete($old_model->$file_one);  
                }
                $folder_location = $old_folder_location ? $old_folder_location : $this->folder_name;
                
                $path = $this->HelperHandleFile($folder_location,$request->file($file_one),$file_one)  ;
                $all += array( $file_one => $path );
            }

            // update
            $this->ModelRepository->update( $id,Request()->except($file_one)+$all) ;
            
            // new model 
            $model = new ModelResource( $this->ModelRepository->findById($id) );

            //  request languages
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
                        $all += array( $key => $value );
                }
                $created_lang = $this->ModelRepositoryLanguage->create( $all ) ;
                if( isset($all['sound_id'] ) ){
                    // attach sound
                    $this->ModelRepositoryLanguage->attachSoundas($all['sound_id'],$created_lang->id);
                }

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
                    $language_models  =  $model->subject_languages()->get() ;
                // get single row of language table
                    $language_model  = $language_models->where('language',$language_array['language'])->first() ;
                $all = [ ];
                foreach ($language_array as $key => $value) {
                        $all += array( $key => $value );
                }
                // for safty
                if($language_model ){
                    $this->ModelRepositoryLanguage->update( $language_model->id,$all ) ;

                }else{
                    $this->ModelRepositoryLanguage->create( $all ) ;
                }
                $new_lang_row  = $this->ModelRepositoryLanguage->findById($language_model->id) ;
                if( isset($all['sound_id'] ) ){

                    // attach sound
                    $this->ModelRepositoryLanguage->attachSoundas($all['sound_id'],$new_lang_row->id);
                }

            }
        // lang update

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
                $file_key_names =['image'];
                foreach ($file_key_names as $value) {
                    //delete folder that has all this row files if exists
                    $this->HelperDeleteDirectory($this->HelperGetDirectory($model->$value));
                }

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
                $image = asset($model->$image_name);
                $model_id = $model->id;
            }
            $this -> TraitNotification($notification_data,$priority='high',$image,$model_name='lesson',$model_id);
        }
    }
}