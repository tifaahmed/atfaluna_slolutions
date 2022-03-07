<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class StoreResource extends JsonResource
{

    public function toArray($request)
    {
        $row=$this->store_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image)) : null,
            'url'           => $this->url,
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
            'languages'     => $this->store_languages,

        ];        
    }
}
