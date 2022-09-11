<?php

namespace App\Http\Resources\Dashboard\ControllerResources\AvatarController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\ControllerResources\AvatarController\SkinResource;

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
            'skins'        =>  SkinResource::collection($this->skins),

            'created_at'   => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'   => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'   => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
//