<?php

namespace App\Http\Resources\Mobile\ControllerResources\UserController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\Collections\ControllerResources\UserController\GovernmentCollection;
use App\Http\Resources\Mobile\Collections\ControllerResources\UserController\CityCollection;
use App\Models\Basic;

class CountryResource extends JsonResource
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
            'name'          => $this->name,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : asset(Storage::url($basic->item)),
            'code'          => $this->code,
            'language'      =>$this->language,
            // 'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            // 'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            // 'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'government'    => new GovernmentCollection ( $this->government ),
            'city'          => new CityCollection ( $this->city ),

        ];

    }
}
// 