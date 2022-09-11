<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SkinController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\SkinLanguageResource ;
use App\Http\Resources\Dashboard\ControllerResources\SkinController\AccessoryResource;
class SkinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->skin_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,

            'name'          => $row ? $row->name:'',
            
            'image'        => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,

            'original'      =>  $this->original,

            'accessory_skin'  => AccessoryResource::collection($this->accessorySkins) , 

            'languages'     => SkinLanguageResource::collection( $this->skin_languages ),


        ];        
    }
}


