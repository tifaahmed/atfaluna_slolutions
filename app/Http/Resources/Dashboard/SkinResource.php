<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
// use App\Http\Resources\Dashboard\AvatarResource;
use App\Http\Resources\Dashboard\SkinLanguageResource ;
use App\Http\Resources\Dashboard\AccessoryResource;

// use App\Http\Resources\Dashboard\Collections\AccessoryCollection;

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

            // 'languages'     => $this->skin_languages,

            // 'accessory_skin'  => AccessoryResource::collection($this->accessorySkins) , 

            'languages'     => SkinLanguageResource::collection( $this->skin_languages ),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

        ];        
    }
}


