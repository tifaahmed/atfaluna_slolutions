<?php

namespace App\Http\Resources\Mobile\ControllerResources\UserController;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Mobile\ControllerResources\UserController\AvatarResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

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
        $basic = Basic::find(1);

        $SubUserSubscription = $this->SubUserSubscriptions()->first();

        $subscription_status = 0 ;
        if (
            $SubUserSubscription && 
            $SubUserSubscription->start <= Carbon::now() && 
            $SubUserSubscription->end >= Carbon::now() 
        ) {
            $subscription_status = 1 ;
        }

        // user avatar
        $subUserAvatarActive = $this->subUserActiveAvatar()->first();
        $active_skin = $subUserAvatarActive ? $subUserAvatarActive->skins()->ActiveSkin($this->id)->first() : null;
        $original_skin  = $subUserAvatarActive ?  $subUserAvatarActive->skins()->Original()->first() : null;
        $skin = $active_skin ? $active_skin  : $original_skin;

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'age'           => $this->age,
            'gender'        => $this->gender,
            'points'        => $this->points,

            // 'avatars'        => new AvatarCollection ($this->subUserAvatar)  ,
            // 'user'         => $this->user,

            'avatar'        =>  
            ($skin && $skin->image  && Storage::disk('public')->exists($skin->image) )
            ? 
            asset(Storage::url($skin->image))  
            :
            asset(Storage::url($basic->item)) ,
            
            'active_age_group'  => $this->ActiveAgeGroup() ? $this->ActiveAgeGroup()->first()  : null ,

            // 'age_groups'         => new AgeGroupCollection  ($this->subUserAgeGroup ) ,
            // 'active_age_group'  => $this->ActiveAgeGroup() ? $this->ActiveAgeGroup()->first()  : null ,
            // 'active_subjects_from_active_age_group'  =>  $this->ActiveSubjectsFromActiveAgeGroup() ? $this->ActiveSubjectsFromActiveAgeGroup()->get() : []   ,

            'subscription_status' =>    $subscription_status ,
            'subscription' =>    $SubUserSubscription ,
        ];        
    }
}
