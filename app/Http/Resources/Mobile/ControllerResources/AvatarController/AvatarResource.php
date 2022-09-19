<?php

namespace App\Http\Resources\Mobile\ControllerResources\AvatarController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\ControllerResources\AvatarController\SkinResource;
use App\Http\Resources\Mobile\ControllerResources\AvatarController\AccessoryResource;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Accessory;
use App\Models\Sub_user;

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
        $original_skin = $this->skins()->Original()->first();
        $not_original_skin = $this->skins()->NotOriginal()->get();


        // $active_skin = null;
        $sub_user_avatar      = 0;
        $can_affort_it = 0 ;
        if ($request->sub_user_id) {

            $sub_user =   Sub_user::find($request->sub_user_id);
            $can_affort_it = ($sub_user->points > $this->price)  ? 1 : 0 ;
                

        //     $active_skin = $this->skins()->ActiveSkin($sub_user_id)->get();

            // taken or not
            $sub_user_avatar = $this->subUserAvatar()->where('sub_user_id',$request->sub_user_id)->first() ;
            $bought = $sub_user_avatar ? 1 : 0; 
            $active = ($sub_user_avatar && $sub_user_avatar->pivot->active )? 1 : 0;
            // can_affort_it or not


        }
        
        // //git accessories of the Skins of the avatar
        
        $accessory_skin = Accessory::whereHas('AccessorySkin', function (Builder $skin_query)  {
            $skin_ids = $this->skins()->pluck('id')->toArray();

            $skin_query->whereIn('skin_id',$skin_ids);
        })->get();

        // //git accessories of the sub_user of the Skins of the avatar

        // $sub_user_accessories_skin = Accessory::whereHas('SubUserAccessory', function (Builder $skin_query) use($sub_user_id) {
        //     $skin_query->where('sub_user_id',$sub_user_id);

        // })
        // ->whereHas('AccessorySkin', function (Builder $skin_query)  {
        //     $skin_ids = $this->skins()->pluck('id')->toArray();

        //     $skin_query->whereIn('skin_id',$skin_ids);
        // })->get();

        
        
        return [
            'id'            => $this->id,
            'type'          =>  $this->type,
            'price'         =>  $this->price ? $this->price : 0,
            



            'avatar_original_skin'          => new SkinResource($original_skin) ,
            'avatar_not_original_skin'      => SkinResource::collection($not_original_skin) ,

            // 'avatar_active_skin'   => $active_skin,

            'active'        => $active ,
            'bought'        => $bought  ,
            'avatar_accessories'         =>   AccessoryResource::collection($accessory_skin)  ,
            // 'sub_user_accessories_skin'         =>   AccessoryResource::collection($sub_user_accessories_skin)   ,
            'can_affort_it' => $can_affort_it
        ];        
    }
}
//