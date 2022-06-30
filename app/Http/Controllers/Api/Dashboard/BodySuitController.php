<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

    // Requests
    use App\Http\Requests\Api\Accessory\BodySuitApiRequest as modelInsertRequest;

    // Resources
    use App\Http\Resources\Dashboard\Collections\BodySuitCollection as ModelCollection;
    use App\Http\Resources\Dashboard\BodySuitResource as ModelResource;


    // lInterfaces
    use App\Repository\BodySuitRepositoryInterface as ModelInterface;

    class BodySuitController extends Controller
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
    
        public function store(modelInsertRequest $request) {
            try {
                $model = $this->ModelRepository->create( Request()->all() );
                
                // attach (1) accessory to (m) human_parts (sync)
                $this->ModelRepository->attachHumanPart($request->human_part_ids,$model->id);

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
    
                
                $this->ModelRepository->update( $id,Request()->all()) ;
                
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