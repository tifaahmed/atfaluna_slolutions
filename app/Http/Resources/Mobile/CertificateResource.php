<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->certificate_languages()->Localization()->RelatedLanguage($this->id)->first();
        return [
            'id'               => $this->id,
            'image_one'        =>  Storage::disk('public')->exists($this->image_one) ? asset(Storage::url($this->image_one))  : null,
            'image_two'        =>  Storage::disk('public')->exists($this->image_one) ? asset(Storage::url($this->image_two))  : null,
            'min_point'        =>  $this->min_point,
            'max_point'        =>  $this->max_point,
            'languages'        => $this->certificate_languages,
            'title_one'        => $row ? $row->title_one:'',
            'created_at'       => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'       => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'       => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
