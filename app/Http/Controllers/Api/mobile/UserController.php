<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Api\User\UserUpdateApiRequest  as modelUpdateRequest;

use Illuminate\Http\Response ;

use App\Http\Resources\Mobile\Collections\UserCollection as ModelCollection;
use App\Http\Resources\Mobile\UserResource as ModelResource;

use App\Repository\UserRepositoryInterface      as ModelInterface;
use App\Repository\CountryRepositoryInterface   as CountryInterface;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;

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
    public function update(modelUpdateRequest $request ,$id){
        try {

            $all = [ ];
            $file_one = 'avatar';
            if ($request->hasFile($file_one)) {
                $all += $this->HelperHandleFile($this->folder_name,$request->file($file_one),$file_one)  ;
                $old_modal = $this->ModelRepository->findById($id); 
                $this->HelperDelete($old_modal->image );
            }

            $password = 'password';
            if($request->password){
                $all += array( $password => Hash::make($request->password) );
            }
            $country= 'country_id';
            if($request->country){
                $all += array( $country => $request->$country );
            }
            
            $this->ModelRepository->update( $id,Request()->except($file_one,$password,'country_id')+$all) ;
            $modal = $this->ModelRepository->findById($id); 

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

    
}
