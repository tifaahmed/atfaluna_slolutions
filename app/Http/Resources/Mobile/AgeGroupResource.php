<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\Collections\SubjectCollection;
use App\Http\Resources\Mobile\CertificateResource;
use Illuminate\Support\Facades\Auth;
class AgeGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->age_group_languages()->Localization()->RelatedLanguage($this->id)->first();

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        $all += [ 'name'     =>  $row ? $row->name:'' ]  ;
        $all += [ 'created_at'     =>  $this->created_at ?   $this->created_at->format('d/m/Y') : null ]  ;
        $all += [ 'updated_at'     =>  $this->updated_at ?   $this->updated_at->format('d/m/Y') : null ]  ;
        $all += [ 'deleted_at'     =>  $this->updated_at ?   $this->updated_at->format('d/m/Y') : null ]  ;
        $all += [ 'subjects'     =>  new SubjectCollection ($this->subjects) ]  ;
        $all += [ 'certification'     =>  new CertificateResource ($this->certificate) ]  ;

        if (isset($request->sub_user_id) && $request->sub_user_id) {
            $sub_user       = Auth::user()->sub_user()->find($request->sub_user_id);
            $sub_user_age_group    = $sub_user->subUserAgeGroupModel()->where('age_group_id',$this->id)->first();
            $all += [ 'taken'     =>  $sub_user_age_group ? 1 :0 ]  ;
            $all += [ 'active'     =>  $sub_user_age_group && $sub_user_age_group->active ? 1 :0 ]  ;
        }
        return $all  ; 
    }
}

