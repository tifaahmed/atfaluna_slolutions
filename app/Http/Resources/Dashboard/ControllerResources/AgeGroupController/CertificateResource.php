<?php

namespace App\Http\Resources\Dashboard\ControllerResources\AgeGroupController;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

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

        return [
            'id'               => $this->id,
            
            'image_three'      =>  Storage::disk('public')->exists($this->image_three) ? asset(Storage::url($this->image_three))  : null,  
            
            'title_two'        => $row ? $row->title_two:'',

        ];        
    }
}
//