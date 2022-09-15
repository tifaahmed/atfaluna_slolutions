<?php

namespace App\Http\Resources\Dashboard\ControllerResources\AgeController;

use Illuminate\Http\Resources\Json\JsonResource;

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
            
            'name'          => $row ? $row->name:'',
            
        ];        
    }
}

