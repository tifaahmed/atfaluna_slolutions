<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Api\User\MobileUserUpdateApiRequest  as modelUpdateRequest;
use App\Http\Requests\Api\User\MobileUserUpdatePasswordRequest  ;

use Illuminate\Http\Response ;
use App\Http\Resources\Mobile\ControllerResources\UserController\UserResource as ModelResource;


use App\Http\Resources\Mobile\Collections\UserCollection as ModelCollection;

// use App\Http\Resources\Mobile\UserResource as ModelResource;

use App\Repository\UserRepositoryInterface      as ModelInterface;
use App\Repository\CountryRepositoryInterface   as CountryInterface;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $ModelRepository;
    private $RepositoryCountry;

    public function __construct(ModelInterface $ModelRepository , CountryInterface $RepositoryCountry){
        $this->ModelRepository = $ModelRepository;
        $this->RepositoryCountry = $RepositoryCountry;
        $this->path = 'user';
        $this->disk = 'public';
        $this->folder_name = 'store';
    }


    
    public function show() {
        return $this -> MakeResponseSuccessful( 
            ['UserModel'  =>  new ModelResource (  Auth::user() )  ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }

    public function apdatePassword(MobileUserUpdatePasswordRequest $request){
        try {
            Auth::user()->update([ 'password' => Hash::make($request->password)]) ;
            return $this -> MakeResponseSuccessful( 
                [ 'UserModel'  => new ModelResource ( Auth::user() ) ],
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


    public function update(modelUpdateRequest $request){
        try {
            Auth::user()->update(Request()->except(['password'])) ;

            return $this -> MakeResponseSuccessful( 
                [ 'UserModel'  =>new ModelResource ( Auth::user() )],
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
