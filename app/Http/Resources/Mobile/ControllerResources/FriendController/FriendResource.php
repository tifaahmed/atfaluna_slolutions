<?php

namespace App\Http\Resources\Mobile\ControllerResources\FriendController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Mobile\ControllerResources\FriendController\SubUserResource;

class FriendResource extends JsonResource
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
            'id'               => $this->id,
            'recevier'               => new SubUserResource($this->sub_user_recevier),

        ];        
    }
}
