<?php

namespace App\Http\Resources\Mobile\ControllerResources\subuserController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\Collections\ControllerResources\subuserController\PlayTimeCollection;
use App\Http\Resources\Mobile\Collections\ControllerResources\subuserController\AgeGroupCollection;
use App\Http\Resources\Mobile\ControllerResources\subuserController\AvatarResource;

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
            'user'         => $this->user,

            'avatar'        => new AvatarResource ($this->avatar)  ,
            'play_time'        => new PlayTimeCollection ($this->playTime)  ,
            'age_groups'         => new AgeGroupCollection  ($this->subUserAgeGroup ) ,
            'active_age_group'  => $this->ActiveAgeGroup() ? $this->ActiveAgeGroup()->first()  : null ,
            'active_subjects_from_active_age_group'  =>  $this->ActiveSubjectsFromActiveAgeGroup() ? $this->ActiveSubjectsFromActiveAgeGroup()->get() : []   ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'subscription_status' =>    $subscription_status ,
            'subscription' =>    $SubUserSubscription ,
        ];        
    }
}