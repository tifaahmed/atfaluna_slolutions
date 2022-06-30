<?php

namespace App\Http\Resources\Mobile\ControllerResources\AvatarController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

class AccessoryResource extends JsonResource
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
        $active = 0 ;
        if ($request->sub_user_id) {
            $sub_user_active_accessory = $this->Sub_user_accessory()
            ->where('sub_user_id',$request->sub_user_id)
            ->where('active',1)
            ->first();
            $active = $sub_user_active_accessory ? 1 : 0 ;
        }

        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        $all += ['image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : asset(Storage::url($basic->item))];
        $all += [ 'active'     =>  $active]  ;

        return $all  ;      
    }
}
