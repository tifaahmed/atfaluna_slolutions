<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\SkinResource;
use App\Http\Resources\Dashboard\Activity\ActivityResource;
use App\Http\Resources\Dashboard\Lesson\LessonResource;

class AccessoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->accessory_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,

            'name'          => $row ? $row->name:'',
            
            'image'        => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,

            'price'         => $this->price,

            'gender'        =>  $this->gender,
            
            'description'   => $row ? $row->description:'' ,

            'languages'     => $this->accessory_languages,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            
        'accessory_skin'       => SkinResource::collection($this->AccessorySkin) , 

        'accessory_activity'     => ActivityResource::collection($this->AccessoryActivity) ,

        'accessory_lesson'     => LessonResource::collection($this->AccessoryLesson)  ,

        ];   
    }
}
