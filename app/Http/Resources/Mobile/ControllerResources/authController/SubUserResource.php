<?php

namespace App\Http\Resources\Mobile\ControllerResources\authController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\Collections\AvatarCollection;
use App\Http\Resources\Mobile\ControllerResources\authController\AvatarResource;
use Carbon\Carbon;


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
        $SubUserSubscription = $this->SubUserSubscriptions()->first();

        $subscription_status = 0 ;
        if (
            $SubUserSubscription && 
            $SubUserSubscription->start <= Carbon::now() && 
            $SubUserSubscription->end >= Carbon::now() 
        ) {
            $subscription_status = 1 ;
        }

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'age'           => $this->age,
            'gender'        => $this->gender,
            'points'        => $this->points,

            'avatars'        => new AvatarCollection ($this->subUserAvatar)  ,
            'avatar'        => new AvatarResource ($this->avatar)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'subscription_status' =>    $subscription_status ,
            'subscription' =>    $SubUserSubscription ,
        ];        
    }
}
