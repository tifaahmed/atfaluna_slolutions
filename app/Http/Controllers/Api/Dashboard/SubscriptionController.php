<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\Subscription\SubscriptionApiRequest as modelInsertRequest;


// Resources
use App\Http\Resources\Dashboard\Collections\SubscriptionCollection as ModelCollection;
use App\Http\Resources\Dashboard\SubscriptionResource as ModelResource;


// lInterfaces
use App\Repository\SubscriptionRepositoryInterface as ModelInterface;
use App\Repository\SubscriptionLanguageRepositoryInterface as ModelInterfaceLanguage; //Languages



class SubscriptionController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
    public function __construct(ModelInterface $Repository,ModelInterfaceLanguage $RepositoryLanguage)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositoryLanguage = $RepositoryLanguage;
        $this->related_language = 'subscription_id';
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
        try {
            return new ModelCollection (  $this->ModelRepository->collection($request->PerPage ? $request->PerPage : 10) )  ;

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


    public function update(modelInsertRequest $request ,$id) {
        try {

            $this->ModelRepository->update( $id,Request()->all()) ;
            
            $model = new ModelResource($this->ModelRepository->findById($id)); 

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
    // lang

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
                    $language_models  =  $model->subscription_languages()->get() ;
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
    // lang
}
