<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

use App\Http\Resources\Dashboard\Collections\GovernmentCollection;
use App\Http\Resources\Dashboard\Collections\CityCollection;

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
            'image'          => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,
            'code'           => $this->code,
            'language'       =>$this->language,

            'created_at'     => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'     => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'     => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'governments'    => new GovernmentCollection ( $this->government ),
            'cities'         => new CityCollection ( $this->city ),

        ];

    }
}
// 