<?php

namespace App\Http\Resources\Dashboard\ControllerResources\AgeGroupController;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\Dashboard\CertificateResource;
use App\Http\Resources\Dashboard\ControllerResources\AgeGroupController\CertificateResource;

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
        return [

            'id'            => $this->id,
            
            'languages'     => $this->age_group_languages,

            'name'          => $row ? $row->name:'',
            
            'age'        => $this->age ,

            'certificate'   =>   new CertificateResource ( $this->certificate )   ,
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
        ];        
    }
}

