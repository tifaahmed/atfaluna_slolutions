<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\SkillController\SkillCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\SkillController\SkillResource as ModelResource;

// lInterfaces
use App\Repository\SkillRepositoryInterface as ModelInterface;
use App\Repository\SkillLanguageRepositoryInterface as ModelInterfaceLanguage; //Languages


class SkillController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
    
    public function __construct(ModelInterface $Repository,ModelInterfaceLanguage $RepositoryLanguage)
    {
        $this->ModelRepository = $Repository;
        $this->ModelRepositoryLanguage = $RepositoryLanguage;
        $this->folder_name = 'skill/'.Str::random(10).time();
        $this->related_language = 'skill_id';
    }
    
    public function all(Request $request){
        try {
            $model =  $this->ModelRepository->filterAll($request->sub_user_id) ;
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
            $model = $this->ModelRepository->filterPaginate($request->sub_user_id , $request->prepage ? $request->prepage : 10);
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

}