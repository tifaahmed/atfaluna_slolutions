<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Resources
use App\Http\Resources\Mobile\Collections\Skill\SkillCollection as ModelCollection;
use App\Http\Resources\Mobile\Skill\SkillResource as ModelResource;

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

}