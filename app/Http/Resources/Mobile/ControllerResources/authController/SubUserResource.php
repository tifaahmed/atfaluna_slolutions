<?php

namespace App\Http\Resources\Mobile\ControllerResources\authController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\Collections\AvatarCollection;
use App\Http\Resources\Mobile\ControllerResources\authController\AvatarResource;


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
        // $SubUserActiveAgeGroup = $this->SubUserActiveAgeGroup() 
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'age'           => $this->age,
            'gender'        => $this->gender,
            'points'        => $this->points,
            // 'user'         => $this->user,

            'avatars'        => new AvatarCollection ($this->subUserAvatar)  ,
            'avatar'        => new AvatarResource ($this->avatar)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
