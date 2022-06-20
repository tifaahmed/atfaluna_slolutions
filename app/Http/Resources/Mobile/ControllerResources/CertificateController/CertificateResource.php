<?php
namespace App\Http\Resources\Mobile\ControllerResources\CertificateController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

use App\Models\Subject;             
use App\Models\Age_group;    

use Auth;
use App\Http\Resources\Mobile\ControllerResources\CertificateController\CertificatabletResource;

class CertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->certificate_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1);

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;

        $all += [ 'min_point'     =>  $this->min_point ]  ;
        $all += [ 'max_point'     =>  $this->max_point ]  ;

        $all += [ 'title_one'     =>  $row ? $row->title_one:'' ]  ;
        $all += [ 'title_two'     =>  $row ? $row->title_two:'' ]  ;
        $all += [ 'description'       =>  $row ? $row->subject:'' ]  ;

        if (isset($request->sub_user_id) && $request->sub_user_id) {
            $sub_user       = Auth::user()->sub_user()->find($request->sub_user_id);
            $subUserCertificate   		= $sub_user->subUserCertificateModel()->where('certificate_id',$this->id)->first();
            
            $all += [ 'taken'     => $subUserCertificate ? 1 : 0 ]  ;

            // 
            $achive_level= 0;
            $achive_points= 0;
            $end_point= 0;
            $image= Storage::disk('public')->exists($this->image_one)  ? asset(Storage::url($this->image_one))     :  asset(Storage::url($basic->item)) ; ; 
            
            if ( $subUserCertificate && $subUserCertificate->points ) {

                if( $subUserCertificate->points >= $this -> min_point && $subUserCertificate->points < $this -> max_point){
                    $achive_level   = 1 ;
                    $end_point      = $this->min_point ;
                    $image = Storage::disk('public')->exists($this->image_two)  ? asset(Storage::url($this->image_two))     :  asset(Storage::url($basic->item)) ;
                }else if( $subUserCertificate->points >= $this -> max_point ){
                    $achive_level = 2 ;
                    $end_point      = $this->max_point ;
                    $image = Storage::disk('public')->exists($this->image_three) ? asset(Storage::url($this->image_three))  :  asset(Storage::url($basic->item)) ;
                }
                $achive_points= $subUserCertificate->points ;

            }

            $all += [ 'achive_points'   => $achive_points   ]  ;
            $all += [ 'end_point'       => $end_point       ]  ;
            $all += [ 'image'           =>  $image          ]  ;

            $all += [ 'certificatable'       => new CertificatabletResource ( $this->certificatable )]  ;

        }


        return  $all;


    }
}
