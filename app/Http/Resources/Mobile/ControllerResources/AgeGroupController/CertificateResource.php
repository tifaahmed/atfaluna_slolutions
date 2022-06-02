<?php

namespace App\Http\Resources\Mobile\ControllerResources\AgeGroupController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;
use Auth;

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
        $all += [ 'subject'       =>  $row ? $row->subject:'' ]  ;

        // $all += [ 'created_at'    =>  $this->created_at ?   $this->created_at->format('d/m/Y') : null ]  ;
        // $all += [ 'updated_at'    =>  $this->updated_at ?   $this->updated_at->format('d/m/Y') : null ]  ;
        // $all += [ 'deleted_at'    =>  $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null ]  ;

        if (isset($request->sub_user_id) && $request->sub_user_id) {
            $sub_user       = Auth::user()->sub_user()->find($request->sub_user_id);
            $subUserCertificate   		= $sub_user->subUserCertificateModel()->where('certificate_id',$this->id)->first();
            
            $all += [ 'taken'     => $subUserCertificate ? 1 : 0 ]  ;

            // 
            $achive_level= 0;
            $achive_points= 0;
            $end_point = $this->min_point;
            $image= Storage::disk('public')->exists($this->image_one)  ? asset(Storage::url($this->image_one))     :  asset(Storage::url($basic->item)) ; ; 
            
            if ($subUserCertificate && $subUserCertificate->points ) {

                if( $subUserCertificate->points >= $this -> min_point && $subUserCertificate->points < $this -> max_point){
                    $achive_level   = 1 ;
                    $image = Storage::disk('public')->exists($this->image_two)  ? asset(Storage::url($this->image_two))     :  asset(Storage::url($basic->item)) ;
                }else if( $subUserCertificate->points >= $this -> max_point ){
                    $achive_level = 2 ;
                    $end_point      = $this->max_point ;
                    $image = Storage::disk('public')->exists($this->image_three) ? asset(Storage::url($this->image_three))  :  asset(Storage::url($basic->item)) ;
                }
                
                $achive_points= $subUserCertificate->points ;

            }

            $all += [ 'achive_level'    =>  $achive_level   ]  ;
            $all += [ 'achive_points'   => $achive_points   ]  ;
            $all += [ 'end_point'       => $end_point       ]  ;
            $all += [ 'image'           =>  $image          ]  ;

        }else {
            $all += [ 'image_one'     => Storage::disk('public')->exists($this->image_one)   ? asset(Storage::url($this->image_one))    : asset(Storage::url($basic->item)) ]  ;
            $all += [ 'image_two'     => Storage::disk('public')->exists($this->image_two)   ? asset(Storage::url($this->image_two))    : asset(Storage::url($basic->item)) ]  ;
            $all += [ 'image_three'   => Storage::disk('public')->exists($this->image_three) ? asset(Storage::url($this->image_three))  : asset(Storage::url($basic->item)) ]  ;    
        }


        return  $all;


    }
}
