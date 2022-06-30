<?php

namespace App\Http\Resources\Mobile\ControllerResources\AvatarController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\ControllerResources\AvatarController\SkinResource;
use App\Http\Resources\Mobile\ControllerResources\AvatarController\AccessoryResource;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Accessory;

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

        $sub_user_id = $request->sub_user_id;
        $active_skin = null;
        $sub_user_avatar      = null;
        if ($sub_user_id) {
            $active_skin = $this->skins()->whereHas('accessorySkins', function (Builder $accessory_query) use($sub_user_id) {
                $accessory_query->whereHas('Sub_user_accessory', function (Builder $sub_user_accessory_query) use($sub_user_id) {
                    $sub_user_accessory_query->where('sub_user_id',$sub_user_id);
                    $sub_user_accessory_query->where('active',1);
                });
            })->first();

            $sub_user_avatar = $this->subUserAvatar()->where('sub_user_id',$sub_user_id)->first();



        }
        $accessories = null;
        $skin_ids = $this->skins()->pluck('id')->toArray();
        if ($skin_ids) {
            $accessories = Accessory::whereHas('AccessorySkin', function (Builder $skin_query) use($skin_ids)  {
                $skin_query->whereIn('skin_id',$skin_ids);
            })->get();
        }

        
        
        return [
            'id'            => $this->id,
            'type'          =>  $this->type,
            'price'         =>  $this->price,
            'avatar_original_skin' => new SkinResource($original_skin) ,
            'avatar_active_skin'   => $active_skin ? new SkinResource($active_skin) : new SkinResource($original_skin),
            'bought'        => $sub_user_avatar ? 1 : 0 ,
            'avatar_accessories'         => $accessories ?  AccessoryResource::collection($accessories) : []  ,
        ];        
    }
}
//