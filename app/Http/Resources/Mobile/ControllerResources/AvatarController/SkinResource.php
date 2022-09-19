<?php

namespace App\Http\Resources\Mobile\ControllerResources\AvatarController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;
use App\Http\Resources\Mobile\ControllerResources\AvatarController\AccessoryResource;

class SkinResource extends JsonResource
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

        return [
            'id'            => $this->id,
            
            'image'        => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : asset(Storage::url($basic->item)) ,
            'original'      =>  $this->original,
            'accessories'      =>  AccessoryResource::collection($this->accessorySkins),
            'accessory_ids'      =>  $this->accessorySkins->pluck('id')->toArray() ,

        ];        
    }
}


