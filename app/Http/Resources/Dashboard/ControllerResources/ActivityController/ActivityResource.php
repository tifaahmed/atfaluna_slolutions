<?php

namespace App\Http\Resources\Dashboard\ControllerResources\ActivityController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\Collections\Activity\ActivityLanguagesCollection;
use App\Http\Resources\Dashboard\ControllerResources\ActivityController\LessonResource;

use Illuminate\Support\Facades\Storage;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->activity_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,    

            'name'          => $row ? $row->name:'',

            'points'        => $this->points ,

            'image'        => $row && $row->image_two &&  Storage::disk('public')->exists($row->image_two)   ?   asset(Storage::url($row->image_two)) :null ,  

            'languages'     => new ActivityLanguagesCollection ($this->activity_languages),

            'lesson'    => new LessonResource ($this->lesson),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];         
    }
}
//