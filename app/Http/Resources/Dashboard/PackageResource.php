<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->package_languages()->Localization()->RelatedLanguage($this->id)->first();
        return [
            'id'            => $this->id,
            'price'         => $this->price,
            'points'        => $this->points,
            'name'          => $row ? $row->name:'',
            'image'        => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            'languages'     => $this->package_languages,
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}
