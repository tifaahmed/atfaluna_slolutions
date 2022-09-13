<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\User\UserStoreApiRequest;
use App\Http\Requests\Api\User\UserUpdateApiRequest;

use Illuminate\Http\Response ;

use App\Http\Resources\Dashboard\Collections\UserCollection as ModelCollection;
use App\Http\Resources\Dashboard\UserResource as ModelResource;

use App\Repository\UserRepositoryInterface      as ModelInterface;
use App\Repository\CountryRepositoryInterface   as CountryInterface;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Hero;
use App\Models\Avatar;
use App\Models\Massage_image;

class UserController extends Controller
{
    private $ModelRepository;
    private $RepositoryCountry;


    public function __construct(ModelInterface $ModelRepository , CountryInterface $RepositoryCountry){
        $this->ModelRepository = $ModelRepository;
        $this->RepositoryCountry = $RepositoryCountry;
        $this->path = 'user';
        $this->disk = 'public';
        $this->folder_name = 'user/'.Str::random(10).time();
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
    public function store(UserStoreApiRequest $request ) {

        $all = [ ];

        $file_one = 'avatar';
        if ($request->hasFile($file_one)) {            
            $path = $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
            $all += array( $file_one => $path );
        }

        $all += array( 'token' => Hash::make( Str::random(60) )  );
        $all += array( 'remember_token' => hash('sha256',Str::random(60)) );
        $all += array( 'password' => Hash::make($request->password) );
        $modal = $this->ModelRepository->create( Request()->except($file_one,'password','password_confirmation')+$all);

        $this->ModelRepository->attachRole($request->role_id ,$modal->id);

        return $this -> MakeResponseSuccessful( 
            ['UserModel'  => $modal]  ,
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function show($id) {
        return $this -> MakeResponseSuccessful( 
            ['UserModel'  => new ModelResource ( $this->ModelRepository->findById($id) )  ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }

    // 
    public function collection(Request $request){
        return  new ModelCollection (  $this->ModelRepository->collection($request->PerPage ? $request->PerPage : 10) ) ;
    }
    // 
    public function destroy($id) {
        $old_data = $this->ModelRepository->findById($id); 
        if ($old_data->avatar) {
            $this->HelperDelete($this->disk, $old_data->avatar  );
        }

        return $this -> MakeResponseSuccessful( 
            [ 'UserModel'  => $this->ModelRepository->deleteById($id) ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function update(UserUpdateApiRequest $request ,$id){
        try {
            $all = [ ];
            $file_one = 'avatar';
            if ($request->hasFile($file_one)) {
                $path = $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
                $all += array( $file_one => $path );
                $old_modal = $this->ModelRepository->findById($id); 
                $this->HelperDelete($old_modal->image );
            }

            $password = 'password';
            if($request->password){
                $all += array( $password => Hash::make($request->password) );
            }
            // $country= 'country_id';
            // if($request->country){
            //     $all += array( $country => $request->$country );
            // }
            
            $modal = $this->ModelRepository->update( $id,Request()->except($file_one,$password)+$all) ;


            $this->ModelRepository->attachRole($request->role_id ,$id);

            return $this -> MakeResponseSuccessful( 
                [ $modal],
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
}
