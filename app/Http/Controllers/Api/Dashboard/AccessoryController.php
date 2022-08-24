<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

    // Requests
    use App\Http\Requests\Api\Accessory\AccessoryApiRequest as modelInsertRequest;
    use App\Http\Requests\Api\Accessory\AccessoryUpdateApiRequest as modelUpdateRequest;

    // Resources
    use App\Http\Resources\Dashboard\Collections\AccessoryCollection as ModelCollection;
    use App\Http\Resources\Dashboard\AccessoryResource as ModelResource;


    // lInterfaces
    use App\Repository\AccessoryRepositoryInterface as ModelInterface;
    use App\Repository\AccessoryLanguageRepositoryInterface as ModelInterfaceLanguage; //Languages

    class AccessoryController extends Controller
    {
        private $Repository;
        private $RepositoryLanguage;
        public function __construct(ModelInterface $Repository,ModelInterfaceLanguage $RepositoryLanguage)
        {
            $this->ModelRepository = $Repository;
            $this->ModelRepositoryLanguage = $RepositoryLanguage;
            $this->folder_name = 'accessory/'.Str::random(10).time();;
            $this->related_language = 'accessory_id';
        }
        public function all(){
            try {
                return $modal = new ModelCollection (  $this->ModelRepository->all() )  ;
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
                // create (1) accessory row
                $model = $this->ModelRepository->create( Request()->except($file_one)+$all ) ;
    
                // attach (1) accessory to (m) Activities (sync)
                $this->ModelRepository->attachActivities($request->activity_ids,$model->id);
                // attach (1) accessory to (m) Lessons  (sync)
                $this->ModelRepository->attachLessons($request->lesson_ids,$model->id);
                // attach (1) accessory to (m) Skins (sync)
                $this->ModelRepository->attachSkins($request->skin_ids,$model->id);
                
                // languages
                $this -> store_array_languages($request->languages,$model) ;
    
                return $this -> MakeResponseSuccessful( 
                    [ new ModelResource( $model ) ],
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
                $old_model = new ModelResource( $this->ModelRepository->findById($id) );
                $all = [ ];
                $file_one = 'image';
                if ($request->hasFile($file_one)) {  
                    $this->HelperDelete($old_model->$file_one);           
                    $path = $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
                    $all += array( $file_one => $path );
                }
                $this->ModelRepository->update( $id,Request()->except($file_one)+$all) ;
                $model =  $this->ModelRepository->findById($id);
                $this -> update_array_languages($request->languages,$model) ;

                // attach (1) accessory to (m) Activities (sync)
                $this->ModelRepository->attachActivities($request->activity_ids,$model->id);
                // attach (1) accessory to (m) Lessons  (sync)
                $this->ModelRepository->attachLessons($request->lesson_ids,$model->id);
                // attach (1) accessory to (m) Skins (sync)
                $this->ModelRepository->attachSkins($request->skin_ids,$model->id);


                return $this -> MakeResponseSuccessful( 
                        [ new ModelResource( $model ) ],
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
        // public function update(modelUpdateRequest $request ,$id) {
        //     try {
        //         $this->ModelRepository->update( $id,Request()->all()) ;
        //         $model = new ModelResource( $this->ModelRepository->findById($id) ); 
        
        //         //  request languages
        //         $this -> update_array_languages($request->languages,$model) ;
    
        //         return $this -> MakeResponseSuccessful( 
        //                 [ $model],
        //                 'Successful'               ,
        //                 Response::HTTP_OK
        //         ) ;
        //     } catch (\Exception $e) {
        //         return $this -> MakeResponseErrors(  
        //             [$e->getMessage()  ] ,
        //             'Errors',
        //             Response::HTTP_NOT_FOUND
        //         );
        //     } 
        // }
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
                    $language_models  =  $model->accessory_languages()->get() ;
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

    }