<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Lesson\LessonResource;
use App\Http\Resources\Dashboard\SubUserResource;

class SubUserLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            
            'lesson'       => new LessonResource (  $this->lesson )  ,
            'sub_user'      => new SubUserResource (  $this->sub_user )  ,

        ];        
    }
}
