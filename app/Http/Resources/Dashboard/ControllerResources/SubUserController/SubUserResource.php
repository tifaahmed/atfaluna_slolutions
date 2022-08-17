<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SubUserController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\PlayTimeResource;

class SubUserResource extends JsonResource
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
            'name'          => $this->name,
            'age'           => $this->age,
            'gender'        => $this->gender,
            'points'        => $this->points,
            'user'          =>  $this->user ,

            'play_time'  =>  PlayTimeResource::collection($this->playTime)  ,


            'active_age_group'    => $this->ActiveAgeGroup() ? $this->ActiveAgeGroup()->first()  : null ,

            'active_subjects_from_active_age_group'  =>  $this->ActiveSubjectsFromActiveAgeGroup() ? $this->ActiveSubjectsFromActiveAgeGroup()->get() : []   ,

            'created_at'            => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'            => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'            => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
