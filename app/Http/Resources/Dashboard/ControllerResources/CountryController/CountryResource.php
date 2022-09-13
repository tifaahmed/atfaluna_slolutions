<?php

namespace App\Http\Resources\Dashboard\ControllerResources\CountryController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

use App\Http\Resources\Dashboard\ControllerResources\CountryController\GovernmentResource;
use App\Http\Resources\Dashboard\ControllerResources\CountryController\CityResource;
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
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'image'        =>  Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            'code'           => $this->code,
            'language'       =>$this->language,

            'governments'       =>  GovernmentResource::collection($this->government),

            'cities'            =>  CityResource::collection($this->city),

            'created_at'     => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'     => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'     => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];

    }
}
// 