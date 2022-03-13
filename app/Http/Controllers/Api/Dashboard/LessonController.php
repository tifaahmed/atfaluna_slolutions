<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Requests
use App\Http\Requests\Api\Lesson\LessonApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\Lesson\LessonCollection as ModelCollection;
use App\Http\Resources\Dashboard\Lesson\LessonResource as ModelResource;

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
        $this->folder_name = 'lesson';
        $this->related_language = 'lesson_id';
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
        try {
            $modal = new ModelResource( $this->ModelRepository->create( Request()->all() ) );

            // // languages
            $this -> update_store_language($request->languages,$modal->id) ;

            return $this -> MakeResponseSuccessful( 
                [ $modal ],
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
    
    public function update(modelInsertRequest $request ,$id) {
        try {
            $this->ModelRepository->update( $id,Request()->all()) ;
            $modal = new ModelResource( $this->ModelRepository->findById($id) ); 

            //  languages
                $this -> update_store_language($request->languages,$modal->id) ;

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
    
    // lang
        public function update_store_language($requested_languages,$modal_id ) {
            if (is_array($requested_languages) ) {
                $this->destroyLanguage($this->related_language,$modal_id);
                foreach ($requested_languages as $key => $language_sigle_row) {
                    $this ->storeLanguage(  $this->handleLanguageData($language_sigle_row,$this->related_language,$modal_id)  );
                }
            }
        }
        public function storeLanguage($language_array ) {
            $all = [ ];
            try {
                foreach ($language_array as $key => $value) {
                    if ($key == 'image') {
                        $file = $key;
                        if (isset($language_array[$file]) && $language_array[$file]) {            
                            $all += $this->HelperHandleFile($this->folder_name,$language_array[$file],$file)  ;
                        }
                    }else{
                        $all += array( $key => $value );
                    }
                }

                $this->ModelRepositoryLanguage->create( $all ) ;

            } catch (\Exception $e) {
                return $this -> MakeResponseErrors(  
                    [$e->getMessage()  ] ,
                    'Errors',
                    Response::HTTP_BAD_REQUEST
                );
            }
        }

        public function destroyLanguage($relation_coulmn,$id) {
            try {
            $this->ModelRepositoryLanguage->deleteByRelation($relation_coulmn,$id) ;
            } catch (\Exception $e) {
                return $this -> MakeResponseErrors(  
                    [$e->getMessage()  ] ,
                    'Errors',
                    Response::HTTP_NOT_FOUND
                );
            }
        }
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