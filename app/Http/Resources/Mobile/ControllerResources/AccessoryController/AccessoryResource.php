<?php

namespace App\Http\Resources\Mobile\ControllerResources\AccessoryController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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
        $row=$this->accessory_languages()->Localization()->RelatedLanguage($this->id)->first();
        $all=[];
        $all += [ 'id'     =>  $this->id ]  ;
        $all += [ 'name'     =>  $row ? $row->name:'' ]  ;
        $all += [ 'price'     =>  $this->price ]  ;
        $all += ['image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : asset(Storage::url($basic->item))];

        if (isset($request->sub_user_id) && $request->sub_user_id) {
            $sub_user       = Auth::user()->sub_user()->find($request->sub_user_id);
            $Sub_user_accessory    = $sub_user->subUserAccessory()->where('accessory_id',$this->id)->first();
            $all += [ 'taken'     =>  $Sub_user_accessory ? 1 :0 ]  ;
        }
        return $all  ;      
    }
}
