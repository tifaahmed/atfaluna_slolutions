<?php

namespace App\Http\Resources\Mobile\ControllerResources\FriendController;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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

        // user avatar
        $basic = Basic::find(1);
        $subUserAvatarActive = $this->subUserActiveAvatar()->first();
        $active_skin = $subUserAvatarActive ? $subUserAvatarActive->skins()->ActiveSkin($this->id)->first() : null;
        $original_skin  = $subUserAvatarActive ?  $subUserAvatarActive->skins()->Original()->first() : null;
        $skin = $active_skin ? $active_skin  : $original_skin;

        // last_seen
        Carbon::setLocale(App::getLocale());
        Carbon::now()->addYear()->diffForHumans();
        $durationTime = $this->durationTime()->latest()->first() ;
        $last_seen = $durationTime ? Carbon::parse($durationTime->updated_at)->diffForHumans()  : null ;

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'avatar'        =>  
            ($skin && $skin->image  && Storage::disk('public')->exists($skin->image) )
            ? 
            asset(Storage::url($skin->image))  
            :
            asset(Storage::url($basic->item)) ,

            'last_seen'          => $last_seen,
            'conversation'          => $this->conversation,

        ];        
    }
}
