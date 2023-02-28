<?php

namespace App\Http\Resources\Dashboard\ControllerResources\AgeController;

use Illuminate\Http\Resources\Json\JsonResource;

// use App\Http\Resources\Dashboard\AgeGroupResource;

use App\Http\Resources\Dashboard\ControllerResources\AgeController\AgeGroupResource;

class AgeResource extends JsonResource
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
            
            'age'           =>  $this->age,


            'age_group'    => new AgeGroupResource ($this->age_group),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}
//