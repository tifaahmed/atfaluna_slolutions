<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SkinController;

use Illuminate\Http\Resources\Json\JsonResource;


class AvatarResource extends JsonResource
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
            'id'           => $this->id,
            'name'         =>  $this->name,
            'type'         =>  $this->type,
            'price'        =>  $this->price,

        ];        
    }
}
//