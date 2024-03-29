<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

//AgeGroupController
// Requests
use App\Http\Requests\Api\McqQuestion\McqQuestionApiRequest as modelInsertRequest;
use App\Http\Requests\Api\McqQuestion\McqQuestionUpdateApiRequest as modelUpdateRequest;


// Resources
// use App\Http\Resources\Dashboard\Collections\McqQuestion\McqQuestionCollection as ModelCollection;
// use App\Http\Resources\Dashboard\McqQuestion\McqQuestionResource as ModelResource;
use App\Http\Resources\Dashboard\Collections\ControllerResources\McqQuestion\McqQuestionCollection as ModelCollection;
use App\Http\Resources\Dashboard\ControllerResources\McqQuestionController\McqQuestionResource as ModelResource;

// lInterfaces
use App\Repository\McqQuestionRepositoryInterface as ModelInterface;
use App\Repository\McqQuestionLanguageRepositoryInterface as ModelInterfaceLanguage; //Languages

class McqQuestionController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
    public function __construct(ModelInterface $Repository,ModelInterfaceLanguage $RepositoryLanguage)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositoryLanguage = $RepositoryLanguage;
        $this->folder_name = 'mcq-question/'.Str::random(10).time();
        $this->related_language = 'mcq_question_id';
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
    public function store(modelInsertRequest $request) {
        $all = [ ];
        $file_one = 'image';
        if ($request->hasFile($file_one)) {            
            $path = $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
            $all += array( $file_one => $path );            
        }
        try {
            $model = new ModelResource( $this->ModelRepository->create( Request()->except($file_one)+$all ) );

            // attach
            $this->ModelRepository->attachQuestionTags($request->question_tag_ids,$model->id);

            // languages
            $this -> store_array_languages($request->languages,$model) ;

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


    public function collection(Request $request){
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
            // find old model row
            $old_model = new ModelResource( $this->ModelRepository->findById($id) );

            // attach
            $this->ModelRepository->attachQuestionTags($request->question_tag_ids,$id);

            // delete & store new files
            $all = [ ];
            $file_one = 'image';
            if ($request->hasFile($file_one)) {  
                // return old folder location of the file
                $old_folder_Directory_location = $this->HelperGetDirectory($old_model->$file_one) ;     
                $location = $old_folder_Directory_location ? $old_folder_Directory_location : $this->folder_name;
                $path = $this->HelperHandleFile($location,$request->file($file_one),$file_one)  ;
                $all += array( $file_one => $path );    
                //delete the old file
                $this->HelperDelete($old_model->$file_one);    
            }
            // update model row
            $this->ModelRepository->update( $id,Request()->except($file_one)+$all) ;

            // find new model row
            $model = new ModelResource( $this->ModelRepository->findById($id) );

            // update languages array
            $this -> update_array_languages($request->languages,$model) ;

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
                if ( $key == 'video'|| $key == 'audio') {
                    if (isset($language_array[$key]) && $language_array[$key]) {    
                        // store the gevin file or image
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
                $language_models  =  $model->mcq_question_languages()->get() ;
            // get single row of language table
                $language_model  = $language_models->where('language',$language_array['language'])->first() ;
            $all = [ ];
            foreach ($language_array as $key => $value) {
                if ( $value && ($key == 'video' || $key == 'audio') ) {
                    // check file value
                    if (isset($language_array[$key]) && $language_array[$key]) {

                        if (isset($language_model->$key) && $language_model->$key) {
                            // get the old directory
                            $old_folder_location = $this->HelperGetDirectory($language_model->$key);    
                            // delete the old file or image
                            $this->HelperDelete($language_model->$key); 
                        }  
                            
                        $location = ( isset($old_folder_location) && $old_folder_location ) ? $old_folder_location : $this->folder_name ;

                        // store the gevin file or image
                        $path =  $this->HelperHandleFile($location,$language_array[$key],$key)  ;
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

                //delete folder that has all this row files if exists
                $this->HelperDeleteDirectory($this->HelperGetDirectory($model->image));
                
                //delete all this row files if exists
                $this->HandleFileDelete($model,$file_key_names);

                // get all related language
                $language_models = $model->mcq_question_languages()->get();
                $language_file_key_names =['videos','audio'];

                foreach ($language_models as  $language_model) {

                    //delete all this row files if exists
                    $this->HandleFileDelete($language_model,$language_file_key_names);

                    foreach ($language_file_key_names as $value) {
                        //delete folder that has all this row files if exists
                        $this->HelperDeleteDirectory($this->HelperGetDirectory($model->$value));
                    }

                }
                $this->ModelRepository->PremanentlyDeleteById($id);

                return $this -> MakeResponseSuccessful( 
                    [ 'Premanently Deleteted'] ,
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

}
